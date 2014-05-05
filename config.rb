require 'sass-globbing'
require 'sass-css-importer'
add_import_path Sass::CssImporter::Importer.new("bower_components")

theme_folder = 'wp-content/themes/mask'
preferred_syntax 			= :sass
http_path 					= "/"
css_dir 					= "#{theme_folder}/css"
sass_dir 					= "#{theme_folder}/sass"
images_dir 					= "#{theme_folder}/img"
javascripts_dir 			= "#{theme_folder}/js"
output_style 				= :expanded
environment 				= :development
relative_assets 			= true
line_comments 				= false
color_output 				= false