<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SiteSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?string $title = 'Site Settings';
    protected static ?int $navigationSort = 99;
    protected static string $view = 'filament.pages.site-settings';

    public array $data = [];

    protected function getForms(): array
    {
        return ['form'];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('🏠 Hero Section')
                    ->description('The first thing visitors see on your homepage.')
                    ->schema([
                        Forms\Components\FileUpload::make('hero_image')
                            ->label('Profile Photo')
                            ->image()
                            ->directory('settings')
                            ->helperText('Upload a half-body or portrait photo. PNG with transparent background looks best.')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('hero_tagline')
                            ->label('Tagline / Role')
                            ->placeholder('Full-Stack Developer')
                            ->maxLength(100),
                        Forms\Components\Textarea::make('hero_bio')
                            ->label('Short Bio')
                            ->placeholder('I specialize in Laravel, modern UI, and scalable backends...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('🔗 Social Links')
                    ->description('Add your social media profile URLs.')
                    ->schema([
                        Forms\Components\TextInput::make('social_github')
                            ->label('GitHub URL')
                            ->url()
                            ->placeholder('https://github.com/yourusername')
                            ->prefixIcon('heroicon-o-globe-alt'),
                        Forms\Components\TextInput::make('social_linkedin')
                            ->label('LinkedIn URL')
                            ->url()
                            ->placeholder('https://linkedin.com/in/yourusername')
                            ->prefixIcon('heroicon-o-globe-alt'),
                        Forms\Components\TextInput::make('social_twitter')
                            ->label('Twitter / X URL')
                            ->url()
                            ->placeholder('https://x.com/yourusername')
                            ->prefixIcon('heroicon-o-globe-alt'),
                        Forms\Components\TextInput::make('social_facebook')
                            ->label('Facebook URL')
                            ->url()
                            ->placeholder('https://facebook.com/yourprofile')
                            ->prefixIcon('heroicon-o-globe-alt'),
                    ])->columns(2),

                Forms\Components\Section::make('📄 Resume & CV')
                    ->schema([
                        Forms\Components\FileUpload::make('cv_file')
                            ->label('Upload CV / Resume (PDF)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('settings')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('resume_cta_text')
                            ->label('Download Button Text')
                            ->placeholder('Download CV')
                            ->maxLength(50),
                    ])->columns(2),

                Forms\Components\Section::make('✉️ Contact Info')
                    ->schema([
                        Forms\Components\TextInput::make('contact_email')
                            ->label('Contact Email')
                            ->email()
                            ->placeholder('hello@yourdomain.com'),
                        Forms\Components\TextInput::make('contact_phone')
                            ->label('Phone Number')
                            ->tel()
                            ->placeholder('+1 234 567 890'),
                        Forms\Components\TextInput::make('contact_location')
                            ->label('Location')
                            ->placeholder('Dhaka, Bangladesh'),
                    ])->columns(2),

                Forms\Components\Section::make('🔍 SEO & Meta')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->placeholder('Khademul Islam — Full-Stack Developer')
                            ->maxLength(70)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->placeholder('I build fast, elegant web applications using Laravel...')
                            ->rows(2)
                            ->maxLength(160)
                            ->columnSpanFull(),
                    ]),

            ])
            ->statePath('data');
    }

    public function mount(): void
    {
        // Load all settings from DB into the form
        $keys = [
            'hero_image', 'hero_tagline', 'hero_bio',
            'social_github', 'social_linkedin', 'social_twitter', 'social_facebook',
            'cv_file', 'resume_cta_text',
            'contact_email', 'contact_phone', 'contact_location',
            'meta_title', 'meta_description',
        ];

        $settings = Setting::whereIn('key', $keys)->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            Setting::set($key, is_array($value) ? $value[0] : $value);
        }

        Notification::make()
            ->title('Settings saved successfully!')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Save Settings')
                ->submit('save'),
        ];
    }
}
