module.exports = function (grunt) {

	require('load-grunt-tasks')(grunt);

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		bowercopy: {
			options: {
				// Bower components folder will be removed afterwards
				clean: true
			},
			libs: {
				options: {
					destPrefix: 'assets'
				},
				files: {
					'jquery-scrolldepth': 'jquery-scrolldepth/*.js',
					'jquery-scrolldepth/readme.md': 'jquery-scrolldepth/readme.md'
				}
			}
		}

	}); // END grunt.initConfig()

	// register tasks
	grunt.registerTask( 'default', [ 'bowercopy' ] );
	grunt.registerTask( 'update-libs', [ 'bowercopy' ] );

};
