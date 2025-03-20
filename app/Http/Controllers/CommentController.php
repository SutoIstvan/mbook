<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Memorial;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comments($id)
    {
        $memorial = Memorial::where('id', $id)->firstOrFail();
        $comments = $memorial->comments()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dashboard.comments', [
            'memorial' => $memorial,
            'comments' => $comments
        ]);
    }

    public function approve(Comment $comment)
    {
        // $this->authorize('moderate', Comment::class);
        
        $comment->update(['status' => 'approved']);
        
        return redirect()->back()->with('success', 'A komment elfogadásra került');
    }

    public function reject(Comment $comment)
    {
        // $this->authorize('moderate', Comment::class);
        
        $comment->update(['status' => 'rejected']);
        
        return response()->json(['message' => 'Комментарий отклонен']);
    }

    public function destroy(Comment $comment)
    {
        // $this->authorize('delete', $comment);
        
        $comment->delete();
        
        return redirect()->back()->with('success', 'A komment törölve');
    }
}
