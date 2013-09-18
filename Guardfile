# A sample Guardfile
# More info at https://github.com/guard/guard#readme

guard 'sass', :input => 'wp-content/themes/test/sass', :output => 'wp-content/themes/test/css', :compass => true

guard 'sprockets', :destination => 'wp-content/themes/test/js/public', :asset_paths => ['wp-content/themes/test/js', 'bower_components/'], :minify => true do
  watch 'wp-content/themes/test/js/script.js'
end

guard 'livereload' do
  watch(%r{wp-content/themes/test/.+\.(erb|haml|slim|php|css)$})
end
