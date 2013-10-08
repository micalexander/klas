# A sample Guardfile
# More info at https://github.com/guard/guard#readme

guard 'sass',
:input => 'wp-content/themes/mask/sass',
:output => 'wp-content/themes/mask/css',
:compass => true,
:compass => {
	:http_path => "/",
	:css_dir => "wp-content/themes/mask/css",
	:sass_dir => "wp-content/themes/mask/sass",
	:images_dir => "wp-content/themes/mask/img",
	:javascripts_dir => "wp-content/themes/mask/js",
	:output_style => :compressed,
	:environment => :development,
	:relative_assets => true,
	:line_comments => false,
	:color_output => false,
}

guard 'sprockets', :destination => 'wp-content/themes/mask/js/public', :asset_paths => ['wp-content/themes/mask/js', 'bower_components/'], :minify => true do
  watch 'wp-content/themes/mask/js/script.js'
end

guard 'livereload' do
  watch(%r{wp-content/themes/mask/.+\.(erb|haml|slim|php|css)$})
end
