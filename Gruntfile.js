module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        postcss: {
            options: {
              processors: [
                require('pixrem')(), // add fallbacks for rem units
                require('autoprefixer-core')({browsers: 'last 3 versions'}), // add vendor prefixes
                require('cssnano')() // minify the result
              ]
            },
            dist: {
              src: 'style.css'
            }  
        },

        concat: {   
            dist: {
                src: [
                    'bower_components/stellar.js/libs/jquery/jquery-1.9.1.js',
                    'bower_components/stellar.js/src/jquery.stellar.js',
                    'bower_components/wow.js/dist/wow.min.js',
                    'bower_components/bootstrap/dist/js/bootstrap.min.js',                    
                    'js/site.js',
                    'js/overlay-menu/classie.js',
                    'js/overlay-menu/modernizr.custom.js',
                    'js/overlay-menu/menu.js'
                ],
                dest: 'js/build/production.js',
                nonull: true
            }
        },

        uglify: {
            build: {
                src: 'js/build/production.js',
                dest: 'js/build/production.min.js'
            }
        },

        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'images/build/'
                }]
            }
        },

        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'style.css': 'style.scss'
                }
            } 
        },

        watch: {
            scripts: {
                files: ['js/*.js'],
                tasks: ['concat', 'uglify'],
                options: {
                    spawn: false,
                },
            },
            css: {
                files: ['**/*.scss'],
                /*
                the streamline is: sass compiles and put the 
                compiled css into style.css then postcss put 
                prefixes and magic in front of every element
                */
                tasks: ['sass', 'postcss']
            }
        },


    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['sass', 'postcss', 'concat', 'uglify', 'imagemin', 'watch']);

};