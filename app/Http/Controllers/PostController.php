<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PostController extends Controller
{
    // Получить все посты
    public function index()
    {
        // return Post::all();
        return PostController::homepage();
    }

    // Создать новый пост
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string'           
        ]);

       
     $post = Post::create($validated);
        
        $slug = Str::slug($request->title) . '-' . $post->post_id;
        $post->slug = $slug;
        $post->save();
    
        return redirect()->route('posts.show', $post)
            ->with('success', 'Post created successfully!');

    }

    // Получить конкретный пост
public function show(Post $post)
{
    return view('posts.show', ['post' => $post]);
}
    public function create(){
        return view('posts.create');
    }

    // Обновить пост
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:posts,slug,'.$post->post_id.',post_id',
            'excerpt' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'rate' => 'sometimes|integer',
        ]);
        // sometimes означает, что проверка указанного поля должна выполняться только если это поле присутствует в запросе.
        // Если поле отсутствует - валидация для него пропускается.
        // Позволяет делать PATCH-запросы (частичное обновление)
        // Не требует отправки всех полей при каждом обновлении
        // Сохраняет существующие значения для неупомянутых полей

        $post->update($validated);

        return $post;
    }

    // Удалить пост
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent();// для возврата HTTP-ответа без тела сообщения и со статус-кодом 204 (No Content). 
        // Это стандартный способ указать, что запрос был успешно обработан, но сервер не возвращает никакого содержимого в ответе
        // Это может быть полезно, когда вы хотите сообщить клиенту, что запрос был успешно обработан, но нет необходимости возвращать какие-либо данные.
        
        // Устанавливает статус-код 204 No Content
        // Не включает тело ответа (Content-Length: 0)
        // Закрывает соединение
        // return null - Laravel преобразует это в 200 OK с пустым телом (не рекомендуется)

        // Почему именно noContent() для удаления:
        // Стандартная практика REST API - для DELETE рекомендуется 204
        // Экономия трафика - не передаются лишние данные
        // Ясность кода - явно показывает намерение разработчика
        // HTTP-спецификация (RFC 7231):
        // 204 статус означает: "Сервер успешно обработал запрос, но не возвращает никакого содержимого"

        // Клиент не должен изменять свое представление документа после получения такого ответа
    }

    // В PostController добавим новый метод
    public function homepage()
    {
        $posts = Post::orderBy('post_id', 'DESC')->get();
        $header = "Последние записи";
        
        return view('welcome', compact('posts', 'header'));
    }


    
}
