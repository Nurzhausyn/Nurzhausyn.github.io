var gulp = require("gulp"),
browserSync = require('browser-sync');

gulp.task('server', function (){
	browserSync({
		port: 9000,
		server: {
			baseDir: 'app'
		}
	});
});

gulp.task('watch', function (){
	gulp.watch([
		'Nurzhausyn.github.io/*.html',
		'Nurzhausyn.github.io/js/**/*.js',
		'Nurzhausyn.github.io/css/**/*.css'
		]) .on('change', browserSync.reload);
});

gulp.task('default', ['server', 'watch']);