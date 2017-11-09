var gulp = require("gulp"),
  watch = require("gulp-watch");

gulp.task("default", function() {
  return gulp
    .src("./development/**/*")
    .pipe(watch("./development/**/*"))
    .pipe(gulp.dest("../status-toggler-sym/"));
});
