gulp = require 'gulp'
coffee = require 'gulp-coffee'
concat = require 'gulp-concat'
wrapper = require 'gulp-wrapper'
sourceMap = require 'gulp-sourcemaps'
watch = require 'gulp-watch'
inject = require 'gulp-inject'
rename = require 'gulp-rename'
scss = require 'gulp-sass'
browserSync = require('browser-sync')
reload = browserSync.reload
exec = require('child_process').exec;


buildFolder = './backend/web'

gulp.task 'server', ->
  exec 'php backend/app/console server:stop -v', (err, stdout, stderr) ->
    exec 'php backend/app/console server:start -v', (err, stdout, stderr) ->
      console.log(stdout)
      console.log(stderr)
      console.log(err)

gulp.task 'scripts', ->
  gulp.src(['./frontend/src/coffee/**/*.coffee','./frontend/src/app.coffee'])
  .pipe concat('app.min.js')
  .pipe sourceMap.init()
  .pipe coffee()
  .pipe sourceMap.write()
  .pipe gulp.dest(buildFolder+'/js')
  .pipe(reload({stream: true}))


gulp.task 'vendor', ->
  gulp.src([
    'node_modules/jquery/dist/jquery.js'
    'node_modules/underscore/underscore.js'
    'node_modules/backbone/backbone.js'
    'node_modules/backbone.marionette/lib/backbone.marionette.js'
  ])
  .pipe concat('vendor.min.js')
  .pipe gulp.dest(buildFolder+'/js')

  gulp.src([
    'node_modules/materialize-css/dist/css/materialize.css'
  ])
  .pipe concat('vendor.min.css')
  .pipe(gulp.dest(buildFolder+'/css'))

  gulp.src([
    'node_modules/materialize-css/dist/fonts/**/*'
  ])
  .pipe(gulp.dest(buildFolder+'/fonts'))

gulp.task 'styles', ->
  gulp.src([
    'frontend/src/**/*.scss'
  ])
  .pipe scss()
  .pipe concat('app.css')
  .pipe(gulp.dest(buildFolder+'/css'))
  .pipe(reload({stream: true}))


gulp.task 'html', ->
  sources = gulp.src(['./frontend/src/**/*html','!./frontend/src/app.html'])
  .pipe rename( (path) ->
    path.dirname = ''
    path.extname = ''
  )
  .pipe wrapper(header: '<script type="text/template" id="${filename}">\n', footer: '</script>\n')
  .pipe concat('templates.html')

  gulp.src(['./frontend/src/app.html'])
  .pipe concat('index.html.twig')
  .pipe inject(sources,
    starttag: '<!-- inject:{{ext}} -->'
    transform: (filePath, file) ->
      file.contents.toString('utf8')
  )
  .pipe gulp.dest(buildFolder+'/../app/Resources/views/layout')
  .pipe reload({stream: true})

gulp.task 'browser-sync', ->
  browserSync(
    proxy: 'localhost:8000'
    port: 3000
    open: true
    notify: false
  )

gulp.task 'watch', ->
  gulp.watch(['./frontend/src/**/*.coffee'], ['scripts'])
  gulp.watch(['./frontend/src/**/*.scss'], ['styles'])
  gulp.watch(['./frontend/src/**/*.html'], ['html'])

gulp.task('default', ['server', 'vendor', 'scripts', 'styles', 'html', 'browser-sync', 'watch'])