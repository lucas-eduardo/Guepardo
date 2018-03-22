module.exports = function( grunt ){

	grunt.initConfig({

		clean:{

			temp: [

				'app/framework/view-compress/',
				'app/framework/externos/js/all.min.js',
				'app/framework/externos/css/all.min.css',
				'app/framework/externos/img/compress',
				'app/adminLTE/view-compress',
				'app/adminLTE/externos/template/dist/css/all.min.css',
				'app/adminLTE/externos/template/dist/js/all.min.js',
				'app/adminLTE/externos/template/img/compress'

			]

		},

		concat: {

			framework: {

				src: [

					'app/framework/externos/lib/jquery/jquery.min.js',
					'app/framework/externos/framework/angularjs/angular.min.js',
					'app/framework/externos/framework/angularjs/i18n/angular-locale_pt-br.js',
					'app/framework/externos/framework/angularjs/angular-animate.min.js',
					'app/framework/externos/framework/angularjs/diretivas/ui-bootstrap-tpls-2.5.0.min.js',
					'app/framework/externos/lib/bootstrap/js/bootstrap.min.js',
					'app/framework/externos/lib/superfish/hoverIntent.js',
					'app/framework/externos/lib/superfish/superfish.min.js',
					'app/framework/externos/lib/morphext/morphext.min.js',
					'app/framework/externos/lib/wow/wow.min.js',
					'app/framework/externos/lib/stickyjs/sticky.js',
					'app/framework/externos/lib/easing/easing.js',
					'app/framework/externos/js/custom.js',
					'app/framework/externos/js/app.js'

				],
				dest: 'app/framework/externos/js/all.min.js'

			},

			adminlte: {

				src: [

					'app/adminLTE/externos/frameworks/jquery/jquery.min.js',
					'app/adminLTE/externos/frameworks/angularjs/angular.min.js',
					'app/adminLTE/externos/frameworks/bootstrap/js/bootstrap.min.js',
					'app/adminLTE/externos/template/dist/js/adminlte.min.js'

				],
				dest: 'app/adminLTE/externos/template/dist/js/all.min.js'

			}

		},

		uglify: {

			framework: {

				src: ['app/framework/externos/js/all.min.js'],
				dest: 'app/framework/externos/js/all.min.js'

			},

			adminlte: {

				src: ['app/adminLTE/externos/template/dist/js/all.min.js'],
				dest: 'app/adminLTE/externos/template/dist/js/all.min.js'

			}

		},

		cssmin: {

			framework: {

				src: [

					'app/framework/externos/lib/bootstrap/css/bootstrap.min.css',
					'app/framework/externos/lib/animate-css/animate.min.css',
					'app/framework/externos/css/style.css'

				],
				dest: 'app/framework/externos/css/all.min.css'

			},

			adminlte: {

				src: [

					'app/adminLTE/externos/frameworks/bootstrap/css/bootstrap.min.css',
					'app/adminLTE/externos/template/dist/css/AdminLTE.min.css',
					'app/adminLTE/externos/template/dist/css/skins/_all-skins.min.css'

				],
				dest: 'app/adminLTE/externos/template/dist/css/all.min.css'

			}

		},

		htmlmin: {

			options: {
				
				removeComments: true,
				collapseWhitespace: true

			},

			framework: {

				expand: true,
				cwd: 'app/framework/visao/',
				src: [

					'index.phtml',
					'menu.phtml',
					'footer.phtml',
					'cabecalho.phtml',
					'index.php',
					'*/*.{phtml,php}'

				],
				dest: 'app/framework/view-compress/'

			},

			adminlte: {

				expand: true,
				cwd: 'app/adminLTE/visao/',
				src: [

					'index.phtml',
					'menu.phtml',
					'rodape.phtml',
					'topo.phtml',
					'index.php',
					'*/*.{phtml,php}'

				],
				dest: 'app/adminLTE/view-compress/'

			}

		},

		imagemin: {

			options: {

                progressive: true,
                optimizationLevel: 3

            },

			framework: {

				files: [{

	                expand: true,
	                cwd: 'app/framework/externos/img/',
	                src: ['*.{png,jpg,gif}'],
	                dest: 'app/framework/externos/img/compress'

            	}]

			},

			adminlte: {

				files: [{

	                expand: true,
	                cwd: 'app/adminLTE/externos/template/img/',
	                src: ['*.{png,jpg,gif}', '*/*.{png,jpg,gif}'],
	                dest: 'app/adminLTE/externos/template/img/compress'

            	}]

			}

		}

	});

	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-htmlmin');
	grunt.loadNpmTasks('grunt-contrib-imagemin');

	grunt.registerTask('default', ['clean', 'concat', 'uglify', 'cssmin', 'htmlmin', 'imagemin']);

}