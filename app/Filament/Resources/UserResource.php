<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\UserDetail;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\RoleEnum;
use Filament\Actions\CreateAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

//    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->minLength(2)
                    ->autocapitalize('words'),
                Forms\Components\TextInput::make('email')
                    ->required(fn ($context) => $context === 'create')  // Required only on create
                    ->unique(ignoreRecord: true) // Unique, but ignore the current record on edit
                    ->email()
                    ->autocomplete(false)
                    ->readOnlyOn('edit'),
                Forms\Components\TextInput::make('password')
                    ->required()
                    ->password()
                    ->revealable()
                    ->autocomplete(false)
                    ->minLength(4)
                    ->maxLength(12)
                    ->visibleOn('create'),
                Forms\Components\Select::make('role')
                    ->options([
                        RoleEnum::User->value => 'User',    // '0' => 'User'
                        RoleEnum::Admin->value => 'Admin',  // '1' => 'Admin'
                    ])
                    ->default(RoleEnum::User->value)
                    ->required()
                    ->placeholder('Select a role')
                    ->native(false),
                Forms\Components\FileUpload::make('avatar')
//                    ->avatar()
                    ->openable()
                    ->previewable(true)
                    ->image()
                    ->disk('public')
                    ->directory('users')
                    ->imageEditor()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Sr no.')
                    ->rowIndex(),
                Tables\Columns\ImageColumn::make('avatar')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->iconColor('primary')  ,
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->color(fn ($state): string => match ($state ?? '') {
                        '0' => 'gray',
                        '1' => 'warning'
                    })
                    ->formatStateUsing(fn ($state) => $state === '0' ? 'User' : ($state === '1' ? 'Admin' : 'Unknown'))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UserAddressesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
