<?php

namespace App\Filament\Schemas;

use App\Filament\Blocks\AboutCompanyBlock;
use App\Filament\Blocks\AdvantagesBlock;

use App\Filament\Blocks\BannerBlock;
use App\Filament\Blocks\ContactsMainBlock;
use App\Filament\Blocks\SliderTextBlock;
use App\Filament\Blocks\ExclamationBlock;
use App\Filament\Blocks\CharacterBlock;
use App\Filament\Blocks\CharacterMainBlock;
use App\Filament\Blocks\DocumentBlock;
use App\Filament\Blocks\MainBrandBlock;
use App\Filament\Blocks\MainDirectionsBlock;
use App\Filament\Blocks\MainNewsBlock;
use App\Filament\Blocks\MainTextBlock;
use App\Filament\Blocks\PartnersBlock;
 
 
use App\Filament\Blocks\SliderSoloBlock;
use App\Filament\Blocks\StandartsBlock;
use App\Filament\Blocks\TextOnImage;
use App\Filament\Blocks\VakansiiBlock;
use App\Filament\Blocks\VakansiiMainBlock;
use App\Filament\Blocks\VideoManyBlock;
use App\Filament\Blocks\VideoSoloBlock;
use App\Filament\Support\MainPageBlocks;
use Awcodes\Curator\Components\Forms\CuratorPicker;

use Filament\Forms\Components\Builder;
 

class ContentBuilder
{
    public static function getSchema(bool $catservice = false, bool $soloservice = false, ?string $template = null): Builder
    {
        return Builder::make('content_blocks')
            ->label('Конструктор')
            ->blocks([


                BannerBlock::make(),

                MainBrandBlock::make()
                    ->visible($template === 'brands'),
                    
                MainNewsBlock::make()
                    ->visible($template === 'news'),

                MainDirectionsBlock::make()
                    ->visible($template === 'directions'),

                ContactsMainBlock::make()    
                    ->visible($template === 'contacts'),

                    
                MainTextBlock::make(),

               // FormBlock::make(),
                AboutCompanyBlock::make(),

                StandartsBlock::make(),

                SliderTextBlock::make(),

                SliderSoloBlock::make(),

                AdvantagesBlock::make(),

                CharacterBlock::make(),

                CharacterMainBlock::make(),

                DocumentBlock::make(),

                VideoSoloBlock::make(),

                VideoManyBlock::make(),
                
                TextOnImage::make(),

                VakansiiBlock::make(),

                VakansiiMainBlock::make(),

                ExclamationBlock::make(),

                PartnersBlock::make(),



                ...MainPageBlocks::getMainPageBlocks(),
                //MainPageBlocks::getBannerMain(),
                MainPageBlocks::getSliderMain(),
            ])
            ->collapsed()
            ->collapsible()
            ->cloneable(); // Позволяет дублировать блоки

    }
}




/*
Для вставки с кастомными классами и тд js в adminpanelprovider

RichEditor::make('content')
                            ->label('Текст')->hintAction(
                                Action::make('openCurator')
                                    ->label('Выбрать из медиатеки')
                                    ->icon('heroicon-m-photo')
                                    ->color('primary')
                                    ->form([
                                        CuratorPicker::make('temp_image')
                                            ->label('Выберите изображение')
                                            ->required(),
                                    ])
                                    ->action(function (array $data, $component) {
                                        $media = Media::find($data['temp_image']);

                                        if ($media) {
                                            $imageUrl = $media->url;
                                            $altText = $media->alt ?? '';
                                            $component->getLivewire()->dispatch(
                                                'insert-content-into-rich-editor',
                                                statePath: $component->getStatePath(),
                                                content: "<img src=\"{$imageUrl}\" alt=\"{$altText}\" />",
                                            );
                                        }
                                    })
                            )

*/