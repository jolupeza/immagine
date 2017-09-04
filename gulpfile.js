'use strict';

var gulp = require('gulp'),
  clean = require('gulp-clean'),
  compass = require('gulp-compass'),
  cssnano = require('gulp-cssnano'),
  gulpif = require('gulp-if'),
  inject = require('gulp-inject'),
  //livereload = require('gulp-livereload'),
  useref = require('gulp-useref'),
  uglify = require('gulp-uglify'),
  postcss = require('gulp-postcss');

var paths = {
  compass: ['./app/sass/**/*.scss']
}

// Pre-procesa archivos SASS a CSS y recarga los cambios
gulp.task('compass', function () {
  gulp.src(paths.compass)
    .pipe(compass({
      css: './app/css/',
      sass: './app/sass/',
      image: './app/images/'
    }))
    .pipe(gulp.dest('./app/css'));
    //.pipe(livereload());
});

// Recarga el navegador cuando hay cambios en el HTML
gulp.task('html', function () {
  gulp.src(['./app/*.html'])
    .pipe(livereload());
});

// Busca en las carpetas de estilos y javascript los archivos que hayamos creado
// para inyectarlos en el default.html
gulp.task('inject', function () {
  var target = gulp.src('./app/*.html');

  return target.pipe(inject(gulp.src('./app/css/**/*.css', {read: false}), {relative: true}))
    .pipe(inject(gulp.src('./app/js/**/*.js', {read: false}), {relative: true}))
    .pipe(gulp.dest('./app/'));
});

gulp.task('postcss', ['compress'], function () {
  return gulp.src('./wp-content/themes/immagine/css/style.min.css')
            .pipe(postcss())
            .pipe(gulp.dest('./wp-content/themes/immagine/css'));
});

// Comprime los archivos CSS y JS enlazados en el index.html y los minifica
gulp.task('compress', function () {
  gulp.src('./app/*.html')
    .pipe(useref())
    .pipe(gulpif('*.js', uglify()))
    .pipe(gulpif('*.css', cssnano()))
    .pipe(gulp.dest('./wp-content/themes/immagine'))
});

// Copia el contenido de los estáticos de index.html al directorio de producción sin tags de comentarios
gulp.task('copy', function () {
  gulp.src('./app/images/**')
    .pipe(gulp.dest('./wp-content/themes/immagine/images'))
  gulp.src('./app/fonts/**')
    .pipe(gulp.dest('./wp-content/themes/immagine/fonts'))
  gulp.src('./node_modules/bootstrap/fonts/**')
    .pipe(gulp.dest('./wp-content/themes/immagine/fonts'))
});

gulp.task('cleanwp', function () {
  return gulp.src([
    'wp-content/themes/immagine/images/',
    'wp-content/themes/immagine/fonts/',
    'wp-content/themes/immagine/css/style.min.css',
    'wp-content/themes/immagine/js/vendor.min.js'
  ], {read: false})
  .pipe(clean());
});

gulp.task('watch', function(){
  //livereload.listen()
  //gulp.watch(['./app/**/*.html'], ['html'])
  gulp.watch(paths.compass, ['compass', 'inject'])
  gulp.watch(['./app/js/**/*.js'], ['inject'])
  // gulp.watch(['./app/js/**/*.js'], ['jshint', 'inject'])
  // gulp.watch(['./bower.json'], ['wiredep'])
})

gulp.task('del', ['cleanwp']);
gulp.task('build', ['postcss', 'copy']);
