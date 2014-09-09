// Load plugins
var gulp = require('gulp'),
	plugins = require('gulp-load-plugins')({ camelize: true }),
	lr = require('tiny-lr'),
	streamqueue = require("streamqueue"),
	pjson = require("./package.json"),
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

	// Watch .js files
	gulp.watch('js/src/*.js', ['scripts']);

	// Watch .php files
	plugins.watch({glob: '*.php'}, function(files){
		files
		.pipe(plugins.livereload(server))
	});
  });
});

gulp.task('scripts', function(){
	gulp.src([
		'js/src/jquery.mousewheel.min.js',
		'js/src/jquery.touchSwipe.min.js',
		'js/src/imagesloaded.js',
		'js/src/isotope.pkgd.min.js',
		'js/src/lecteur.js'
	])
	.pipe(plugins.concat('lecteur.min.js'))
	.pipe(gulp.dest('js/'))
});

gulp.task('zip', function () {
    var date = new Date().toISOString().replace(/[^0-9]/g, ''),
        stream = streamqueue({ objectMode: true });

    stream.queue(
        gulp.src(
            [
            	"./*",
                "fonts/**/*",
                "images/**/*",
                "inc/**/*",
                "js/*",
                "!js/src/*",
                "languages/*",
                "layouts/*",
                "!less",
                "!node_modules",
                "!.git",
                "!.gitignore",
                "!git-archive-all",
                "!gulpfile.js",
                "!package.json"
            ],
            {base: "."})
    );

    stream.queue(
        gulp.src("build/**/*", {base: "build/"})
    );

    // once preprocess ended, concat result into a real file
    return stream.done()
        .pipe(plugins.zip("lecteur.zip"))
        .pipe(gulp.dest("dist/"));
});

// Default task
gulp.task('default', ['less', 'scripts', 'watch']);