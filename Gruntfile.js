module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    bower: grunt.file.readJSON('.bowerrc'),
    paths: {
        source: 'dev',
        destination: 'prod'
    },
    clean: {
      prod: {
        src: ['<%= paths.destination %>']
      }
    },
    copy: {
      prod: {
        cwd: '<%= paths.source %>',
        src: ['**/*', '!**/assets/img/**', '!**/assets/css/**', '!**/assets/js/**', '!**/assets/lib/**'],
        expand: true,
        dot: true,
        dest: '<%= paths.destination %>'
      },
      jquery: {
        files: [{
          cwd: '<%= paths.source %>/assets/lib/jquery/dist/',
          src: ['jquery.min.js'],
          expand: true,
          dest: '<%= paths.destination %>/assets/lib/jquery'
        },
        {
          cwd: '<%= paths.source %>/assets/lib/jquery/dist/',
          src: ['jquery.min.map'],
          expand: true,
          dest: '<%= paths.destination %>/assets/lib/jquery'
        }]
      },
      bootstrap: {
        files: [{
          cwd: '<%= paths.source %>/assets/lib/bootstrap/dist/js',
          src: ['bootstrap.min.js'],
          expand: true,
          dest: '<%= paths.destination %>/assets/lib/bootstrap/js'
        },
        {
          cwd: '<%= paths.source %>/assets/lib/bootstrap/dist/fonts',
          src: ['**'],
          expand: true,
          dest: '<%= paths.destination %>/assets/lib/bootstrap/fonts'
        }]
      }
    },
    cssmin: {
      minify: {
        expand: true,
        cwd: '<%= paths.source %>/assets/css',
        src: ['**/*.css', '**/*.min.css'],
        dest: '<%= paths.destination %>/assets/css',
        ext: '.min.css'
      }
    },
    less: {
      bootstrap: {
        options: {
          paths: ["<%= paths.destination %>/assets/lib/bootstrap/css"],
          cleancss: true,
        },
        files: {
          "<%= paths.destination %>/assets/lib/bootstrap/css/bootstrap.min.css": "<%= paths.source %>/assets/lib/bootstrap/less/bootstrap.less"
        }
      }
    },
    uglify: {
      js: {
        files: [{
            expand: true,
            cwd: '<%= paths.source %>/assets/js',
            src: '**/*.js',
            dest: '<%= paths.destination %>/assets/js',
            ext: '.min.js'
        }]
      }
    },
    imagemin: {
      dynamic: {
          files: [{
              expand: true,
              cwd: '<%= paths.source %>/assets/img',
              src: ['**/*.{png,jpg,gif}'],
              dest: '<%= paths.destination %>/assets/img'
          }]
      }
    },
    jshint: {
      all: ['Gruntfile.js', '<%= paths.source %>/assets/js/**/*.js', '<%= paths.destination %>/assets/js/**/*.js']
    }
  });

  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-jshint');

  grunt.registerTask('default', ['clean','cssmin','copy','less','jshint','uglify','imagemin']);

};