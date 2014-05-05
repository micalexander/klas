# A sample Guardfile
# More info at https://github.com/guard/guard#readme

theme_folder = 'wp-content/themes/mask'


group :development do
	guard 'sprockets', :destination => "#{theme_folder}/js/public", :asset_paths => ["#{theme_folder}/js/", 'bower_components/'], :minify => true, :root_file => '#{theme_folder}/js/public/script.js' do
	 	watch(%r{#{theme_folder}/.+\.(js)$})
	end

	guard 'livereload' do
	 	watch(%r{#{theme_folder}/.+\.(erb|haml|slim|php|css|js)$})
	end

	if File.exists?("config.rb")
		# Compile on start.
		puts `compass compile --time --quiet`
		# https://github.com/guard/guard-compass
		guard :compass, configuration_file: 'config.rb', project_path: '.', compile_on_start: true  do
			watch(%r{#{theme_folder}/.+\.(css|scss)$})
		end
	end
end