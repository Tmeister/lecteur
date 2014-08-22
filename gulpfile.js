// Load plugins
var gulp = require('gulp'),
	plugins = require('gulp-load-plugins')({ camelize: true }),
	lr = require('tiny-lr'),
	server = lr();

// Styles
gulp.task('styles', function() {
  return gulp.src('less/style.less')
  	.pipe(plugins.less())
	.pipe(plugins.livereload(server))
	.pipe(gulp.dest('./'))
	.pipe(plugins.notify({ message: 'Styles task complete' }));
});

// Watch
gulp.task('watch', function() {

  // Listen on port 35729
  server.listen(35729, function (err) {
	if (err) {
	  return console.log(err)
	};

	// Watch .scss files
	gulp.watch('less/**/*.less', ['styles']);

  });

});

// Default task
gulp.task('default', ['styles', 'watch']);