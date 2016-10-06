// require gulp
var gulp = require('gulp');
// require other packages
var concat = require('gulp-concat');
var rename = require("gulp-rename");
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var cssnano = require('gulp-cssnano');

var theme = "./wp-content/themes/piratar";

////////// tasks

// concat and minify scripts task
gulp.task('scripts', function() {
  gulp.src([
      './components/jquery/dist/jquery.js',
      './components/jquery-instagram/dist/instagram.js',
      //'./components/bootstrap/dist/js/bootstrap.js',
      theme + '/js/site.js'
    ])
    .pipe(concat('piratar.js'))
    .pipe(gulp.dest(theme + '/js/'))
    .pipe(uglify())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(theme + '/js/'))
});

//compile and minify less styles task
gulp.task('styles', function(){
  gulp.src([
      theme + '/css/*.scss'
    ])
    .pipe(concat('piratar.scss'))
    .pipe(sass())
    .pipe(gulp.dest(theme + '/css/'))
    .pipe(cssnano())
    .pipe(rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(theme + '/css/'))
});

//watch task
gulp.task('watch', function(){
  gulp.watch(theme + '/js/site.js', ['scripts']);
  gulp.watch(theme + '/css/*.scss', ['styles']);
});

//define default task
gulp.task('default', ['scripts', 'styles', 'watch']);
