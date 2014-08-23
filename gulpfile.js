// Load plugins
var gulp = require('gulp'),
	plugins = require('gulp-load-plugins')({ camelize: true }),
	lr = require('tiny-lr'),
	server = lr();

// Styles
gulp.task('less', function() {
  return gulp.src('less/style.less')
  	.pipe(plugins.less())
	.pipe(plugins.livereload(server))
	.pipe(gulp.dest('./'))
});

// Watch
gulp.task('watch', function() {

  // Listen on port 35729
  server.listen(35728, function (err) {
	if (err) {
	  return console.log(err)
	};

	// Watch .less files
	gulp.watch('less/**/*.less', ['less']);

	// Watch .php files
	plugins.watch({glob: '*.php'}, function(files){
		files
		.pipe(plugins.livereload(server))
	});


  });

});

// Default task
gulp.task('default', ['less', 'watch']);