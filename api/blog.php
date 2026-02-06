<?php
/**
 * Blog API Endpoint for n8n Integration
 * 
 * Endpoints:
 * GET /api/blog.php - List all blogs
 * GET /api/blog.php?slug=xxx - Get single blog
 * POST /api/blog.php - Create new blog (requires API key)
 * PUT /api/blog.php?id=xxx - Update blog (requires API key)
 * DELETE /api/blog.php?id=xxx - Delete blog (requires API key)
 * 
 * n8n Integration:
 * - Use HTTP Request node with POST method
 * - Set header: X-API-Key: YOUR_API_KEY
 * - Set header: Content-Type: application/json
 * - Body should contain blog data as JSON
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-API-Key');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Configuration
define('BLOGS_FILE', __DIR__ . '/../content/blogs/blogs.json');
define('API_KEY', getenv('BLOG_API_KEY') ?: 'ardena-blog-api-key-2026'); // Set via environment variable

// Helper functions
function loadBlogs() {
    if (!file_exists(BLOGS_FILE)) {
        return ['blogs' => []];
    }
    $content = file_get_contents(BLOGS_FILE);
    return json_decode($content, true) ?: ['blogs' => []];
}

function saveBlogs($data) {
    $dir = dirname(BLOGS_FILE);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    return file_put_contents(BLOGS_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

function generateSlug($title) {
    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return trim($slug, '-');
}

function validateApiKey() {
    $headers = getallheaders();
    $apiKey = $headers['X-API-Key'] ?? $headers['x-api-key'] ?? $_GET['api_key'] ?? '';
    return $apiKey === API_KEY;
}

function respondError($message, $code = 400) {
    http_response_code($code);
    echo json_encode(['error' => $message, 'success' => false]);
    exit();
}

function respondSuccess($data, $message = 'Success') {
    echo json_encode(['success' => true, 'message' => $message, 'data' => $data]);
    exit();
}

// Route handling
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $data = loadBlogs();
        $blogs = $data['blogs'];
        
        // Filter by status (only show published by default)
        $showAll = isset($_GET['all']) && validateApiKey();
        if (!$showAll) {
            $blogs = array_filter($blogs, fn($b) => ($b['status'] ?? 'published') === 'published');
        }
        
        // Get single blog by slug
        if (isset($_GET['slug'])) {
            $slug = $_GET['slug'];
            $blog = array_values(array_filter($blogs, fn($b) => $b['slug'] === $slug));
            if (empty($blog)) {
                respondError('Blog not found', 404);
            }
            respondSuccess($blog[0]);
        }
        
        // Get single blog by id
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $blog = array_values(array_filter($blogs, fn($b) => $b['id'] === $id));
            if (empty($blog)) {
                respondError('Blog not found', 404);
            }
            respondSuccess($blog[0]);
        }
        
        // Sort by date (newest first)
        usort($blogs, fn($a, $b) => strtotime($b['published_date'] ?? '2000-01-01') - strtotime($a['published_date'] ?? '2000-01-01'));
        
        // Pagination
        $page = max(1, intval($_GET['page'] ?? 1));
        $limit = min(50, max(1, intval($_GET['limit'] ?? 10)));
        $offset = ($page - 1) * $limit;
        
        $total = count($blogs);
        $blogs = array_slice($blogs, $offset, $limit);
        
        respondSuccess([
            'blogs' => array_values($blogs),
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'pages' => ceil($total / $limit)
            ]
        ]);
        break;
        
    case 'POST':
        if (!validateApiKey()) {
            respondError('Unauthorized', 401);
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input || !isset($input['title'])) {
            respondError('Title is required');
        }
        
        $data = loadBlogs();
        
        $id = $input['id'] ?? generateSlug($input['title']) . '-' . time();
        $slug = $input['slug'] ?? generateSlug($input['title']);
        
        // Check for duplicate slug
        $existing = array_filter($data['blogs'], fn($b) => $b['slug'] === $slug);
        if (!empty($existing)) {
            $slug .= '-' . time();
        }
        
        $newBlog = [
            'id' => $id,
            'title' => $input['title'],
            'slug' => $slug,
            'excerpt' => $input['excerpt'] ?? substr(strip_tags($input['content'] ?? ''), 0, 200) . '...',
            'content' => $input['content'] ?? '',
            'author' => $input['author'] ?? 'Ardena Team',
            'category' => $input['category'] ?? 'General',
            'tags' => $input['tags'] ?? [],
            'featured_image' => $input['featured_image'] ?? '/img/blog/default.jpg',
            'published_date' => $input['published_date'] ?? date('Y-m-d'),
            'status' => $input['status'] ?? 'published',
            'meta_title' => $input['meta_title'] ?? $input['title'] . ' | Ardena',
            'meta_description' => $input['meta_description'] ?? $input['excerpt'] ?? ''
        ];
        
        $data['blogs'][] = $newBlog;
        saveBlogs($data);
        
        respondSuccess($newBlog, 'Blog created successfully');
        break;
        
    case 'PUT':
        if (!validateApiKey()) {
            respondError('Unauthorized', 401);
        }
        
        $id = $_GET['id'] ?? null;
        if (!$id) {
            respondError('Blog ID is required');
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            respondError('Invalid JSON input');
        }
        
        $data = loadBlogs();
        $found = false;
        
        foreach ($data['blogs'] as &$blog) {
            if ($blog['id'] === $id) {
                $blog = array_merge($blog, $input);
                $blog['id'] = $id; // Preserve original ID
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            respondError('Blog not found', 404);
        }
        
        saveBlogs($data);
        respondSuccess($blog, 'Blog updated successfully');
        break;
        
    case 'DELETE':
        if (!validateApiKey()) {
            respondError('Unauthorized', 401);
        }
        
        $id = $_GET['id'] ?? null;
        if (!$id) {
            respondError('Blog ID is required');
        }
        
        $data = loadBlogs();
        $originalCount = count($data['blogs']);
        $data['blogs'] = array_values(array_filter($data['blogs'], fn($b) => $b['id'] !== $id));
        
        if (count($data['blogs']) === $originalCount) {
            respondError('Blog not found', 404);
        }
        
        saveBlogs($data);
        respondSuccess(null, 'Blog deleted successfully');
        break;
        
    default:
        respondError('Method not allowed', 405);
}
