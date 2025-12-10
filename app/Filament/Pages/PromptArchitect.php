<?php

namespace App\Filament\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\CreativePrompt;
use Illuminate\Support\HtmlString;
use Filament\Notifications\Notification;

class PromptArchitect extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static string $view = 'filament.pages.prompt-architect';

    protected static ?string $navigationGroup = 'AI Tools';

    // State properties
    public ?string $domain = null;
    public ?string $intent_description = null;
    public ?array $image_settings = [];
    public ?array $text_settings = [];
    public ?array $video_settings = [];
    public ?array $code_settings = [];
    public ?array $research_settings = [];
    public ?string $generated_prompt = null;
    public ?string $recommended_tool = null;
    public ?string $tips = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    // Step 1: Intent Analysis
                    Forms\Components\Wizard\Step::make('Intent Analysis')
                        ->description('What do you want to create?')
                        ->schema([
                            Forms\Components\Radio::make('domain')
                                ->label('Select Domain')
                                ->options([
                                    'image' => 'Image Generation (Visuals, Logos, UI Design)',
                                    'text' => 'Text/Copywriting (Articles, Emails, Scripts)',
                                    'video' => 'Video Generation (Motion, Animation, Clips)',
                                    'coding' => 'Coding/Dev (Scripts, Functions, Debugging)',
                                    'research' => 'Research/Analysis (Data, Summaries)',
                                ])
                                ->required()
                                ->live()
                                ->afterStateUpdated(fn () => $this->resetResults()),

                            Forms\Components\Textarea::make('intent_description')
                                ->label('Description')
                                ->placeholder('Describe what you want to create...')
                                ->required()
                                ->rows(3),
                        ]),

                    // Step 2: Refinement
                    Forms\Components\Wizard\Step::make('Refinement')
                        ->description('Fine-tune your request')
                        ->schema([
                            // Image Settings
                            Forms\Components\Group::make()
                                ->schema([
                                    Forms\Components\Select::make('image_settings.ratio')
                                        ->label('Aspect Ratio')
                                        ->options([
                                            '16:9' => '16:9 (Landscape)',
                                            '9:16' => '9:16 (Portrait/TikTok)',
                                            '1:1' => '1:1 (Square)',
                                            '4:3' => '4:3 (Classic)',
                                            'other' => 'Other',
                                        ])
                                        ->required(),

                                    Forms\Components\Select::make('image_settings.style')
                                        ->label('Style')
                                        ->options([
                                            'photorealistic' => 'Photorealistic (8k)',
                                            '3d_render' => '3D Render/Pixar Style',
                                            'minimalist' => 'Minimalist/Flat Design',
                                            'anime' => 'Anime/Manga',
                                            'cyberpunk' => 'Cyberpunk',
                                            'other' => 'Other',
                                        ])
                                        ->required(),

                                    Forms\Components\Select::make('image_settings.lighting')
                                        ->label('Lighting/Mood')
                                        ->options([
                                            'natural' => 'Natural Sunlight',
                                            'cinematic' => 'Cinematic/Moody',
                                            'neon' => 'Neon/Studio',
                                            'soft' => 'Soft/Pastel',
                                            'other' => 'Other',
                                        ])
                                        ->required(),

                                    Forms\Components\Section::make('Advanced Parameters')
                                        ->schema([
                                            Forms\Components\Textarea::make('image_settings.negative_prompt')
                                                ->label('Negative Prompt (What to avoid)')
                                                ->placeholder('blurry, low quality, distorted...'),

                                            Forms\Components\Grid::make(3)
                                                ->schema([
                                                    Forms\Components\TextInput::make('image_settings.seed')
                                                        ->label('Seed')
                                                        ->numeric(),

                                                    Forms\Components\TextInput::make('image_settings.chaos')
                                                        ->label('Chaos (0-100)')
                                                        ->numeric()
                                                        ->minValue(0)
                                                        ->maxValue(100),

                                                    Forms\Components\Select::make('image_settings.view_angle')
                                                        ->label('View Angle')
                                                        ->options([
                                                            'eye_level' => 'Eye Level',
                                                            'low_angle' => 'Low Angle',
                                                            'high_angle' => 'High Angle (Bird\'s Eye)',
                                                            'drone' => 'Drone Shot',
                                                            'macro' => 'Macro (Close up)',
                                                        ]),
                                                ]),
                                        ])
                                        ->collapsible()
                                        ->icon('heroicon-m-adjustments-horizontal'),
                                ])
                                ->visible(fn (\Filament\Forms\Get $get) => $get('domain') === 'image'),

                            // Text Settings
                            Forms\Components\Group::make()
                                ->schema([
                                    Forms\Components\Select::make('text_settings.type')
                                        ->label('Content Type')
                                        ->options([
                                            'email' => 'Email/Newsletter',
                                            'blog' => 'Blog Post/Article',
                                            'social' => 'Social Media Post',
                                            'ad' => 'Ad Copy',
                                            'creative' => 'Creative Writing/Story',
                                            'technical' => 'Technical Documentation',
                                        ])
                                        ->required(),

                                    Forms\Components\Select::make('text_settings.tone')
                                        ->label('Tone')
                                        ->options([
                                            'professional' => 'Professional/Corporate',
                                            'casual' => 'Casual/Friendly',
                                            'persuasive' => 'Persuasive/Sales',
                                            'witty' => 'Witty/Humorous',
                                            'academic' => 'Academic/Formal',
                                        ])
                                        ->required(),

                                    Forms\Components\TextInput::make('text_settings.target_audience')
                                        ->label('Target Audience')
                                        ->placeholder('e.g. CEO, Teenagers, Tech Enthusiasts'),

                                    Forms\Components\Textarea::make('text_settings.key_points')
                                        ->label('Key Points to Include')
                                        ->rows(3),
                                ])
                                ->visible(fn (\Filament\Forms\Get $get) => $get('domain') === 'text'),

                            // Video Settings
                            Forms\Components\Group::make()
                                ->schema([
                                    Forms\Components\Select::make('video_settings.platform')
                                        ->label('Platform')
                                        ->options([
                                            'youtube' => 'YouTube (Long Form)',
                                            'tiktok' => 'TikTok/Reels/Shorts',
                                            'cinematic' => 'Cinematic/Movie',
                                            'commercial' => 'Commercial/Ad',
                                        ])
                                        ->required(),

                                    Forms\Components\Select::make('video_settings.style')
                                        ->label('Visual Style')
                                        ->options([
                                            'realistic' => 'Live Action/Realistic',
                                            'animation' => 'Animation/2D/3D',
                                            'stock' => 'Stock Footage Compilation',
                                            'vlog' => 'Vlog/Person Talking',
                                        ])
                                        ->required(),

                                    Forms\Components\TextInput::make('video_settings.duration')
                                        ->label('Estimated Duration')
                                        ->placeholder('e.g. 60 seconds, 10 minutes'),

                                    Forms\Components\Textarea::make('video_settings.visuals')
                                        ->label('Specific Visual Ideas')
                                        ->placeholder('Describe specific scenes or shots...')
                                        ->rows(2),
                                ])
                                ->visible(fn (\Filament\Forms\Get $get) => $get('domain') === 'video'),

                            // Coding Settings
                            Forms\Components\Group::make()
                                ->schema([
                                    Forms\Components\Select::make('code_settings.language')
                                        ->label('Language')
                                        ->options([
                                            'python' => 'Python',
                                            'javascript' => 'JavaScript/TypeScript',
                                            'php' => 'PHP/Laravel',
                                            'html_css' => 'HTML/CSS',
                                            'sql' => 'SQL',
                                            'other' => 'Other',
                                        ])
                                        ->required(),

                                    Forms\Components\Select::make('code_settings.task_type')
                                        ->label('Task Type')
                                        ->options([
                                            'script' => 'Script/Automation',
                                            'function' => 'Single Function/Method',
                                            'feature' => 'Full Feature Implementation',
                                            'debug' => 'Diff/Debugging/Fix',
                                            'test' => 'Unit Tests',
                                        ])
                                        ->required(),

                                    Forms\Components\TextInput::make('code_settings.frameworks')
                                        ->label('Frameworks/Libraries')
                                        ->placeholder('e.g. React, Pandas, Tailwind'),
                                ])
                                ->visible(fn (\Filament\Forms\Get $get) => $get('domain') === 'coding'),

                            // Research Settings
                            Forms\Components\Group::make()
                                ->schema([
                                    Forms\Components\Select::make('research_settings.goal')
                                        ->label('Research Goal')
                                        ->options([
                                            'summary' => 'Summarize Topic',
                                            'analysis' => 'Deep Analysis/Critique',
                                            'comparison' => 'Comparison (A vs B)',
                                            'history' => 'Historical Context',
                                        ])
                                        ->required(),

                                    Forms\Components\Select::make('research_settings.format')
                                        ->label('Output Format')
                                        ->options([
                                            'bullet' => 'Bullet Points',
                                            'essay' => 'Essay/Article',
                                            'table' => 'Structured Table',
                                        ])
                                        ->required(),

                                    Forms\Components\TextInput::make('research_settings.sources')
                                        ->label('Preferred Sources (Optional)')
                                        ->placeholder('e.g. Academic papers, News sites'),
                                ])
                                ->visible(fn (\Filament\Forms\Get $get) => $get('domain') === 'research'),
                        ]),

                    // Step 3: Generation
                    Forms\Components\Wizard\Step::make('Generation')
                        ->description('Get your perfect prompt')
                        ->schema([
                            Forms\Components\Placeholder::make('results_placeholder')
                                ->content(new HtmlString('
                                    <div class="text-sm text-gray-500">
                                        Click "Generate" below to create your prompt.
                                    </div>
                                ')),

                            Forms\Components\Actions::make([
                                Forms\Components\Actions\Action::make('generate')
                                    ->label('Generate Prompt with Gemini')
                                    ->icon('heroicon-m-sparkles')
                                    ->color('primary')
                                    ->action(fn (\App\Services\GeminiContentService $gemini) => $this->generate($gemini)),

                                Forms\Components\Actions\Action::make('save_to_history')
                                    ->label('Save to History')
                                    ->icon('heroicon-m-bookmark')
                                    ->color('success')
                                    ->visible(fn () => !empty($this->generated_prompt))
                                    ->action(fn () => $this->savePrompt()),
                            ]),
                        ]),
                ])
                ->submitAction(new HtmlString('')) // Hide default submit button
            ])->columns(1);
    }

    public function generate(\App\Services\GeminiContentService $gemini)
    {
        $data = $this->form->getState();
        $domain = $data['domain'] ?? null;

        if ($domain === 'image') {
            $desc = $data['intent_description'] ?? '';
            $settings = $data['image_settings'] ?? [];

            $ratio = $settings['ratio'] ?? '16:9';
            $style = $settings['style'] ?? 'photorealistic';
            $lighting = $settings['lighting'] ?? 'natural';
            $negative = $settings['negative_prompt'] ?? '';
            $seed = $settings['seed'] ?? '';
            $chaos = $settings['chaos'] ?? '';
            $view = $settings['view_angle'] ?? '';

            // Construct Meta Prompt for Gemini
            $metaPrompt = "Act as an expert Prompt Engineer for Midjourney v6.
            I need a highly detailed, optimized prompt based on this user request:
            - Subject: {$desc}
            - Style: {$style}
            - Lighting: {$lighting}
            - Aspect Ratio: {$ratio}
            - View Angle: {$view}
            - Chaos: {$chaos}
            - Seed: {$seed}
            - Negative Prompt Considerations: {$negative}

            Please write a SINGLE, raw string for the final Midjourney prompt.
            Include necessary parameters like --ar {$ratio} (convert to ratio format if needed), --v 6.0, --stylize (high if artistic).
            Do NOT include markdown formatting or explanations. Just the prompt string.";

            try {
                $this->generated_prompt = $gemini->generateText($metaPrompt);

                // Recommend Tool
                $this->recommended_tool = 'Midjourney v6';
                if ($style === 'text_in_image' || str_contains($style, 'text')) {
                    $this->recommended_tool = 'DALL-E 3';
                }

                $this->tips = "Gemini has optimized this prompt for you. Check parameters like --ar and --v.";

            } catch (\Exception $e) {
                \Filament\Notifications\Notification::make()
                    ->title('Generation Failed')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
            }

        } elseif ($domain === 'text') {
            $desc = $data['intent_description'] ?? '';
            $settings = $data['text_settings'] ?? [];
            $type = $settings['type'] ?? 'general';
            $tone = $settings['tone'] ?? 'professional';
            $audience = $settings['target_audience'] ?? 'general audience';
            $points = $settings['key_points'] ?? '';

            $metaPrompt = "Act as a professional copywriter and prompt engineer.
            I need a clear, structured prompt for an AI (like ChatGPT or Claude) to write the following:
            - Type: {$type}
            - Topic/Description: {$desc}
            - Tone: {$tone}
            - Target Audience: {$audience}
            - Key Points to Include: {$points}

            Please write the OPTIMIZED PROMPT that I should paste into ChatGPT to get the best result.
            The prompt you write should use a persona, clear instructions, and constraints.";

             try {
                $this->generated_prompt = $gemini->generateText($metaPrompt);
                $this->recommended_tool = 'ChatGPT (GPT-4) / Claude 3 Opus';
                $this->tips = "Use this prompt in ChatGPT or Claude. Adjust specific details if needed.";
            } catch (\Exception $e) {
                // ... error handling
                 \Filament\Notifications\Notification::make()->title('Error')->body($e->getMessage())->danger()->send();
            }

        } elseif ($domain === 'video') {
            $desc = $data['intent_description'] ?? '';
            $settings = $data['video_settings'] ?? [];
            $platform = $settings['platform'] ?? 'youtube';
            $style = $settings['style'] ?? 'realistic';
            $duration = $settings['duration'] ?? '1 minute';
            $visuals = $settings['visuals'] ?? '';

            $metaPrompt = "Act as an expert Video Production Prompt Engineer for tools like Sora, Runway Gen-2, or Pika Labs.
            I need a detailed prompt to generate a video based on:
            - Description: {$desc}
            - Platform: {$platform}
            - Visual Style: {$style}
            - Duration: {$duration}
            - Specific Visual Ideas: {$visuals}

            Write TWO outputs:
            1. A 'Script/Scene Description' prompt for AI Video generators.
            2. A set of specific keywords for style and camera movement.
            Combine them into a single comprehensive prompt text.";

            try {
                $this->generated_prompt = $gemini->generateText($metaPrompt);
                $this->recommended_tool = 'Runway Gen-2 / Sora / Pika';
                $this->tips = "Experiment with the 'Motion' slider in Runway or camera controls in Pika using these keywords.";
            } catch (\Exception $e) {
                 \Filament\Notifications\Notification::make()->title('Error')->body($e->getMessage())->danger()->send();
            }

        } elseif ($domain === 'coding') {
            $desc = $data['intent_description'] ?? '';
            $settings = $data['code_settings'] ?? [];
            $lang = $settings['language'] ?? 'python';
            $task = $settings['task_type'] ?? 'script';
            $frameworks = $settings['frameworks'] ?? 'standard library';

            $metaPrompt = "Act as a Senior Software Engineer.
            I need a highly specific prompt to ask an AI Coding Assistant (like GitHub Copilot or Cursor) to perform this task:
            - Task: {$desc}
            - Language: {$lang}
            - Type: {$task}
            - Frameworks: {$frameworks}

            Write the prompt I should use. It should include:
            - Role definition (Act as...)
            - Step-by-step requirements
            - Code style preferences (Clean, commented, modern syntax)
            - Error handling requirements";

            try {
                $this->generated_prompt = $gemini->generateText($metaPrompt);
                $this->recommended_tool = 'GitHub Copilot / Cursor / GPT-4';
                $this->tips = "Paste this into your IDE's AI chat or a model like GPT-4 for code generation.";
            } catch (\Exception $e) {
                 \Filament\Notifications\Notification::make()->title('Error')->body($e->getMessage())->danger()->send();
            }

        } elseif ($domain === 'research') {
            $desc = $data['intent_description'] ?? '';
            $settings = $data['research_settings'] ?? [];
            $goal = $settings['goal'] ?? 'summary';
            $format = $settings['format'] ?? 'bullet';
            $sources = $settings['sources'] ?? 'general';

            $metaPrompt = "Act as a Lead Researcher.
            I need a powerful prompt to instruct an AI to perform deep research on:
            - Topic: {$desc}
            - Research Goal: {$goal}
            - Preferred Output Format: {$format}
            - Sources to Prioritize: {$sources}

            Write the prompt. Ensure it asks for citations, neutral point of view, and structured data analysis.";

            try {
                $this->generated_prompt = $gemini->generateText($metaPrompt);
                $this->recommended_tool = 'Perplexity AI / ChatGPT (Browsing)';
                $this->tips = "For research, Perplexity AI is often best. This prompt ensures high-quality sourcing.";
            } catch (\Exception $e) {
                 \Filament\Notifications\Notification::make()->title('Error')->body($e->getMessage())->danger()->send();
            }

        } else {
             $this->generated_prompt = "Please select a valid domain.";
        }
    }

    public function savePrompt()
    {
        try {
            CreativePrompt::create([
                'prompt_text' => $this->generated_prompt ?? '', // Fallback though it should be set
                'domain' => $this->domain,
                'description' => $this->intent_description,
                'settings' => [
                    'image_settings' => $this->image_settings,
                    'text_settings' => $this->text_settings,
                    'video_settings' => $this->video_settings,
                    'code_settings' => $this->code_settings,
                    'research_settings' => $this->research_settings,
                ],
                'generated_prompt' => $this->generated_prompt,
                'recommended_tool' => $this->recommended_tool,
            ]);

            Notification::make()
                ->title('Saved to History')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Failed to Save')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function loadPrompt(CreativePrompt $record)
    {
        $this->domain = $record->domain;
        $this->intent_description = $record->description;

        $settings = $record->settings ?? [];
        $this->image_settings = $settings['image_settings'] ?? [];
        $this->text_settings = $settings['text_settings'] ?? [];
        $this->video_settings = $settings['video_settings'] ?? [];
        $this->code_settings = $settings['code_settings'] ?? [];
        $this->research_settings = $settings['research_settings'] ?? [];

        $this->generated_prompt = $record->generated_prompt ?? $record->prompt_text; // Fallback for old records
        $this->recommended_tool = $record->recommended_tool;
        $this->tips = "Loaded from history.";

        $this->form->fill([
            'domain' => $this->domain,
            'intent_description' => $this->intent_description,
            'image_settings' => $this->image_settings,
            'text_settings' => $this->text_settings,
            'video_settings' => $this->video_settings,
            'code_settings' => $this->code_settings,
            'research_settings' => $this->research_settings,
        ]);

        Notification::make()->title('Prompt Loaded')->success()->send();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(CreativePrompt::query()->latest())
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Date')->sortable(),
                Tables\Columns\TextColumn::make('domain')->badge()->color('info'),
                Tables\Columns\TextColumn::make('description')->limit(30)->label('Intent'),
                Tables\Columns\TextColumn::make('generated_prompt')->limit(50)->label('Prompt Content'),
            ])
            ->actions([
                Tables\Actions\Action::make('load')
                    ->label('Load')
                    ->icon('heroicon-m-arrow-path')
                    ->color('warning')
                    ->action(fn (CreativePrompt $record) => $this->loadPrompt($record)),

                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                //
            ]);
    }

    public function resetResults()
    {
        $this->generated_prompt = null;
        $this->recommended_tool = null;
        $this->tips = null;
    }
}
