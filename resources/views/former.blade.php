{!! Former::horizontal_open(url('profile'))
            ->id('profile')
            ->method('POST'); !!}

{!! Former::text('name')
            ->label('Name')
            ->required(); !!}

{!! Former::text('city')
            ->label('City')
            ->required(); !!}

{!! Former::actions()
            ->large_primary_submit('Submit')
            ->large_inverse_reset('Reset'); !!}

{!! Former::close(); !!}