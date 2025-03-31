// tasks/assets.js
import gulp from 'gulp';
import path from '../config/path';

const assets = () => {
	return gulp.src(path.assets.src)
		.pipe(gulp.dest(path.assets.dest));
};

export default assets;
