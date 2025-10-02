<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\UserModel;
use CodeIgniter\CodeIgniter;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Exceptions\HTTPException;

class Articles extends BaseController
{
  private $cache;

  public function __construct()
  {
    $this->cache = \Config\Services::cache();
  }

  public function showBySlug($slug)
  {
    $data = array();
    $data['navbar'] = '';

    $articleModel = new ArticleModel();
    $article = $this->getArticleDetail($slug);

    if (empty($article)) throw new HttpException('Artikel tidak ditemukan.', 404);

    $data['metaTag'] = $article['metaTag'];
    $data['article'] = $article['content'];
    $data['articles'] = $this->getLatestArticles();

    $pageContent = view('pages/article', $data);

    return $pageContent;
  }

  private function getArticleDetail($slug)
  {
    $cacheKey = 'viewArticleDetail'. $slug;

    if ($this->cache->get($cacheKey) === null) {

      $articleModel = new ArticleModel();
      $article = $articleModel->where('slug', $slug)->first();

      if (empty($article)) throw new HttpException('Artikel tidak ditemukan.', 404);

      $partialView = view('templates/article_detail', ['article' => $article]);

      $metaTag = $this->initializeMetaTags(array(
        'title' => strip_tags($article['title']),
        'description' => $article['resume']
      ));

      $return = array('content' => $partialView, 'metaTag' => $metaTag);

      $this->cache->save($cacheKey, $return, 60);
    }

    return $this->cache->get($cacheKey);
  }

  private function getLatestArticles()
  {
    $cacheKey = 'viewLatestArticlesDetail';

    if ($this->cache->get($cacheKey) === null) {

      $articleModel = new ArticleModel();
      $articles = $articleModel->where('status', 'publish')->findAll(3);

      $partialView = view('templates/articles_section', ['articles' => $articles]);

      $this->cache->save($cacheKey, $partialView, 60);
    }

    return $this->cache->get($cacheKey);
  }
}
