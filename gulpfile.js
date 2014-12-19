var browserSync = require('browser-sync'),
    reload      = browserSync.reload,
    gulp        = require('gulp'),
    less        = require('gulp-less'),
    uncss       = require('gulp-uncss'),
    minifyCss   = require('gulp-minify-css'),
    concat      = require('gulp-concat'),
    uglify      = require('gulp-uglify'),
    shell       = require('gulp-shell'),
    zip         = require('gulp-zip'),
    pkg         = require('./package.json');

// Browser Sync
gulp.task('browser-sync', function () {
  browserSync({
    open: false,
    proxy: 'localhost/wordpress'
  });
});

// Development styles
gulp.task('styles:development', function () {
  return gulp.src('./assets/less/styles.less')
    .pipe(less({ paths: './assets' }))
    .pipe(gulp.dest('./built/css'))
    .pipe(reload({ stream: true }));
});

// Production styles (be sure to create all test contents)
gulp.task('styles:production', function () {
  return gulp.src('./assets/less/styles.less')
    .pipe(less({ paths: './assets' }))
    .pipe(uncss({
      ignore: [
        /navbar/,
        /mfp/,
        /form-horizontal/,
        /background/,
        /item-/,
        /animate/,
        /fade/,
        /response/,
        /error/
      ],
      html: ['http://localhost/wordpress']
    }))
    .pipe(minifyCss())
    .pipe(gulp.dest('./built/css'));
});

// Build vendor scripts
gulp.task('scripts:vendors', function() {
  return gulp.src([
      './bower_components/jquery/dist/jquery.js',
      './bower_components/fullpage.js/vendors/jquery.slimscroll.min.js',
      './bower_components/fullpage.js/jquery.fullPage.js',
      './bower_components/retinajs/dist/retina.js',
      './bower_components/masonry/dist/masonry.pkgd.js',
      './bower_components/underscore/underscore.js',
      './bower_components/backbone/backbone.js',
      './bower_components/magnific-popup/dist/jquery.magnific-popup.js',
      './bower_components/jquery-validation/dist/jquery.validate.js'
    ])
    .pipe(concat('vendors.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./built/js'))
    .pipe(reload({ stream: true }));
});

// Build app scripts
gulp.task('scripts:app', function() {
  return gulp.src('./assets/js/**/*.js')
    .pipe(concat('app.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./built/js'))
    .pipe(reload({ stream: true }));
});

// Get optiontree from github repo
gulp.task('optiontree', shell.task([
  'rm -rf option-tree',
  'git clone https://github.com/valendesigns/option-tree.git'
]));

// Build Wordpress Theme
gulp.task('theme', [
  'styles:production',
  'scripts:app',
  'scripts:vendors'
], function () {
  return gulp.src([
      '*.php',
      'style.css',
      'screenshot.jpg',
      'built/**/*',
      'includes/**/*',
      'templates/**/*',
      'option-tree/**/*'
    ], { base: './' })
    .pipe(zip(pkg.name + '-' + pkg.version + '.zip'))
    .pipe(gulp.dest('./'));
});

// Default development task
gulp.task('default', [
  'styles:development',
  'scripts:app',
  'scripts:vendors',
  'browser-sync'
], function () {
  gulp.watch('./**/*.php', reload);
  gulp.watch('./assets/less/**/*.less', ['styles:development']);
  gulp.watch('./assets/js/**/*.js', ['scripts:app']);
});
