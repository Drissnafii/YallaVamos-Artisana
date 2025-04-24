<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the news articles.
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('pages.news.index', compact('news'));
    }

    /**
     * Display a comprehensive archive of all news articles.
     */
    public function archive()
    {
        $news = News::latest()->paginate(15);
        return view('pages.news.archive', compact('news'));
    }

    /**
     * Display the press releases page.
     */
    public function pressReleases()
    {
        // Get all press release files from the storage or database
        $pressReleases = [
            [
                'title' => 'FIFA Morocco Meeting Outcomes',
                'description' => 'Results from the latest coordination meeting between FIFA and Morocco',
                'date' => 'March 15, 2025',
                'file' => 'press-releases/fifa-morocco-meeting.pdf',
                'size' => '2.4 MB'
            ],
            [
                'title' => 'World Cup 2030 Volunteer Program Launch',
                'description' => 'Details about the volunteer recruitment program for the tournament',
                'date' => 'February 28, 2025',
                'file' => 'press-releases/volunteer-program.pdf',
                'size' => '1.8 MB'
            ],
            [
                'title' => 'Official Mascot Announcement',
                'description' => 'Introduction of the official mascot for the 2030 World Cup',
                'date' => 'January 10, 2025',
                'file' => 'press-releases/mascot-announcement.pdf',
                'size' => '3.2 MB'
            ],
            [
                'title' => 'Stadium Construction Progress Report',
                'description' => 'Quarterly update on stadium construction and renovations',
                'date' => 'December 5, 2024',
                'file' => 'press-releases/stadium-progress-q4-2024.pdf',
                'size' => '4.7 MB'
            ],
            [
                'title' => 'Transportation Infrastructure Investments',
                'description' => 'Overview of transportation improvements for the World Cup',
                'date' => 'November 20, 2024',
                'file' => 'press-releases/transportation-investments.pdf',
                'size' => '2.9 MB'
            ],
        ];

        return view('pages.news.press-releases', compact('pressReleases'));
    }

    /**
     * Display the specified news article.
     */
    public function show($id)
    {
        $article = News::findOrFail($id);
        $relatedArticles = News::where('id', '!=', $article->id)
                            ->latest()
                            ->take(3)
                            ->get();

        return view('pages.news.show', compact('article', 'relatedArticles'));
    }

    /**
     * Subscribe to the newsletter.
     */
    public function subscribe(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        // Newsletter subscription logic would go here

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
