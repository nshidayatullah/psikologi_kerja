<?php

namespace App\Filament\Resources\Signers;

use App\Filament\Resources\Signers\Pages\EditSigner;
use App\Filament\Resources\Signers\Pages\ListSigners;
use App\Filament\Resources\Signers\Schemas\SignerForm;
use App\Filament\Resources\Signers\Tables\SignersTable;
use App\Models\Signer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SignerResource extends Resource
{
    protected static ?string $model = Signer::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Penanda Tangan';

    protected static ?string $pluralLabel = 'Penanda Tangan';

    protected static ?string $modelLabel = 'Penanda Tangan';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return SignerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SignersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSigners::route('/'),
            'edit' => EditSigner::route('/{record}/edit'),
        ];
    }
}
