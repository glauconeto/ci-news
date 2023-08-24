<?php

namespace App\Controllers;

use App\Models\newsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
  public function index()
  {
      $model = model(NewsModel::class);

      $data = [
          'news'  => $model->getNews(),
          'title' => 'Nossas notícias',
      ];

      return view('templates/header')
        . view('news/index', $data)
        . view('templates/footer');
  }
  
  public function view($slug = null)
  {
      $model = model(NewsModel::class);

      $data['news'] = $model->getNews($slug);

      if (empty($data['news'])) {
          throw new PageNotFoundException('Não foi possível encontrar a notícia: ' . $slug);
      }

      $data['title'] = $data['news']['title'];

      return view('templates/header')
          . view('news/view', $data)
          . view('templates/footer');
  }

  public function create()
    {
        helper('form');

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', ['title' => 'Criar nova notícia'])
                . view('news/create')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['title', 'body']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return view('templates/header', ['title' => 'Criar nova notícia'])
                . view('news/create')
                . view('templates/footer');
        }

        $model = model(NewsModel::class);

        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);

        return view('templates/header', ['title' => 'Criar nova notícia'])
            . view('news/success')
            . view('templates/footer');
    }
}
