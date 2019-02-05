@if (count($items))

    <div class="card">
        @include('_card', [
            'is_text' => true,
            'item' => $items[0],
        ])
        
    </div><?php if(isset($items[1])):?><div class="card-short-wrapper"><div class="card card_short">
        @include('_card', [
            'is_text' => false,
            'item' => $items[1],
        ])

        </div><?php if(isset($items[2])):?><div class="card card_short">
        @include('_card', [
            'is_text' => false,
            'item' => $items[2],
        ])
        </div><?php endif?></div><?php endif?><?php if(isset($items[3])):?><div class="card">
        @include('_card', [
            'is_text' => true,
            'item' => $items[3],
        ])

    </div><?php endif;?><?php if(isset($items[4])):?><div class="card-short-wrapper"><div class="card card_short">
        @include('_card', [
            'is_text' => false,
            'item' => $items[4],
        ])
        </div><?php if(isset($items[5])):?><div class="card card_short">
            @include('_card', [
                'is_text' => false,
                'item' => $items[5],
            ])

        </div><?php endif;?></div><?php endif;?><?php if(isset($items[6])):?><div class="card">
            @include('_card', [
                'is_text' => true,
                'item' => $items[6],
            ])

    </div><?php endif;?><?php if(isset($items[7])):?><div class="card-short-wrapper">
        <div class="card card_short">
            @include('_card', [
                'is_text' => false,
                'item' => $items[7],
            ])
        </div>
        <?php if(isset($items[8])):?>
        <div class="card card_short">
            @include('_card', [
                'is_text' => false,
                'item' => $items[8],
            ])
        </div>
        <?php endif;?>
    </div>
    <?php endif;?>

@endif