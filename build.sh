#!/bin/bash

# Build script to convert PHP to static HTML for Netlify deployment

# Create dist directory
mkdir -p dist

# Start PHP server temporarily
php -S localhost:9999 -t . &
PHP_PID=$!
sleep 2

# List of pages to convert
PAGES=(
    "index.php:index.html"
    "contact-us.php:contact-us.html"
    "services.php:services.html"
    "industries.php:industries.html"
    "portfolios.php:portfolios.html"
    "blog.php:blog.html"
    "blog-post.php:blog-post.html"
    "marketing-assessment.php:marketing-assessment.html"
    "careers.php:careers.html"
    "privacy-policy.php:privacy-policy.html"
    "terms-and-conditions.php:terms-and-conditions.html"
    "cookie-policy.php:cookie-policy.html"
    "404.php:404.html"
    "branding.php:branding.html"
    "digital-marketing1.php:digital-marketing1.html"
    "media-production.php:media-production.html"
    "web-development.php:web-development.html"
)

# Convert main pages
for page in "${PAGES[@]}"; do
    src="${page%%:*}"
    dest="${page##*:}"
    if [ -f "$src" ]; then
        echo "Converting $src to $dest"
        curl -s "http://localhost:9999/$src" > "dist/$dest"
    fi
done

# Convert portfolio detail pages
mkdir -p dist/portfolio
for file in portfolio/*.php; do
    if [ -f "$file" ]; then
        name=$(basename "$file" .php)
        echo "Converting $file to portfolio/$name.html"
        curl -s "http://localhost:9999/$file" > "dist/portfolio/$name.html"
    fi
done

# Convert service pages
mkdir -p dist/service
for file in service/*.php; do
    if [ -f "$file" ]; then
        name=$(basename "$file" .php)
        echo "Converting $file to service/$name.html"
        curl -s "http://localhost:9999/$file" > "dist/service/$name.html"
    fi
done

# Convert industry pages
mkdir -p dist/industry
for file in industry/*.php; do
    if [ -f "$file" ]; then
        name=$(basename "$file" .php)
        echo "Converting $file to industry/$name.html"
        curl -s "http://localhost:9999/$file" > "dist/industry/$name.html"
    fi
done

# Copy static assets
echo "Copying static assets..."
cp -r css dist/
cp -r js dist/
cp -r img dist/
cp -r content dist/
cp -r api dist/

# Kill PHP server
kill $PHP_PID 2>/dev/null

echo "Build complete! Output in dist/"
