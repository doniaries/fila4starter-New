<?php


// use Illuminate\Database\Eloquent\Builder;
namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                // Kolom Kiri (2/3 lebar)
                Group::make()
                    ->columnSpan(2)
                    ->schema([
                        // Section: Konten Berita
                        Section::make('Konten Berita')
                            ->description('Informasi utama berita')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Berita')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Masukkan judul berita')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                                    ->columnSpanFull()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->hidden()
                                    ->dehydrated(),
                                RichEditor::make('content')
                                    ->label('Konten Berita')
                                    ->required()
                                    ->toolbarButtons([
                                        ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                        ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                        ['table', 'attachFiles'],
                                        ['undo', 'redo'],
                                    ])
                                    ->extraInputAttributes(['style' => 'min-height: 300px;'])
                                    ->placeholder('Tulis konten berita di sini...')
                                    ->columnSpanFull(),
                                TextInput::make('source_link')
                                    ->label('Link Sumber Berita')
                                    ->placeholder('Contoh: https://detik.com/berita-terbaru')
                                    ->url()
                                    ->maxLength(255)
                                    ->columnSpanFull()
                                    ->hintIcon('heroicon-m-information-circle', tooltip: 'Masukkan link sumber berita jika mengambil konten dari website lain'),
                            ])
                            ->columns(1)
                            ->collapsible(),
                        // Section: Data
                        Section::make('Dokumentasi')
                            ->description('Upload foto dan galeri')
                            ->schema([
                                FileUpload::make('foto_utama')
                                    ->label('Foto Utama')
                                    ->image()
                                    // ->required()
                                    ->disk('public')
                                    ->directory('posts')
                                    ->visibility('public')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                                    ->maxSize(5120)
                                    ->helperText('Upload foto utama (max 5MB). Format: JPEG, JPG, PNG, WEBP. Akan dikonversi ke WebP.')
                                    ->saveUploadedFileUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file) {
                                        return \App\Helpers\ImageHelper::convertToWebp($file, 'posts', 1024);
                                    })
                                    ->columnSpanFull(),
                                TextInput::make('caption_foto_utama')
                                    ->label('Keterangan Foto Utama')
                                    ->placeholder('Masukkan keterangan foto utama...')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                Repeater::make('gallery')
                                    ->label('Foto Galeri')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('Foto')
                                            ->image()
                                            ->disk('public')
                                            ->directory('posts/galleries')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ])
                                            ->maxSize(5120)
                                            ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp'])
                                            ->helperText('Max 5MB. Format: JPEG, JPG, PNG, WEBP')
                                            ->saveUploadedFileUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file) {
                                                return \App\Helpers\ImageHelper::convertToWebp($file, 'posts/galleries', 1024);
                                            }),
                                        TextInput::make('caption')
                                            ->label('Keterangan')
                                            ->placeholder('Masukkan keterangan foto...')
                                            ->maxLength(255),
                                    ])
                                    ->columnSpanFull()
                                    ->defaultItems(0)
                                    ->reorderableWithButtons()
                                    ->collapsible()
                                    ->itemLabel(fn(array $state): ?string => $state['caption'] ?? 'Foto Galeri')
                                    ->collapsed(),
                            ])
                            ->collapsible(),
                    ]),

                // Kolom Kanan (1/3 lebar)
                Group::make()
                    ->columnSpan(1)
                    ->schema([


                        // Section: Metadata
                        Section::make('Metadata')
                            ->description('Pengaturan publikasi')
                            ->schema([
                                Select::make('user_id')
                                    ->label('Penulis')
                                    ->relationship('user', 'name', modifyQueryUsing: fn($query) => $query->whereHas('roles'))
                                    ->default(fn() => Auth::id())
                                    ->disabled()
                                    ->dehydrated()
                                    ->default(fn() => Auth::id())
                                    ->columnSpanFull(),
                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'archived' => 'Archived',
                                    ])
                                    ->required()
                                    ->default('published')
                                    ->visible(function () {
                                        /** @var \App\Models\User $user */
                                        $user = Auth::user();
                                        return $user && !$user->hasRole('contributor');
                                    })
                                    ->columnSpanFull(),
                                DateTimePicker::make('published_at')
                                    ->label('Tanggal Publikasi')
                                    ->default(now())
                                    ->native(false)
                                    ->displayFormat('d F Y H:i')
                                    ->columnSpanFull(),
                                Select::make('tags')
                                    ->label('Kategori Berita')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->required()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Nama Kategori Berita')
                                            ->required()
                                            ->unique('tags', 'name', ignoreRecord: true)
                                            ->maxLength(255),
                                    ])
                                    ->columnSpanFull(),
                                Toggle::make('is_featured')
                                    ->label('Tampilkan di Slider')
                                    ->helperText('Aktifkan untuk menampilkan berita ini di slider halaman utama')
                                    ->default(true)
                                    ->columnSpanFull(),
                            ])
                            ->collapsible(),
                    ]),
            ]);
    }
}
