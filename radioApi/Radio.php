<?php
class Radio{
    private $status = 'off';
    private $mode = 'AM';
    private $chanel = '';
    private $favoriteChannels = [];

    public function turn(){
        if ($this->status == 'on'){
            $this->status= 'off';
        } else {
            $this->status='on';
        }
        return $this->status;
    }

    public function mode(){
        if ($this->mode == 'FM'){
            $this->mode= 'AM';
        } else {
            $this->mode='FM';
        }
        return $this->mode;
    }

    public function randomMode(){
        if ($this->mode == 'FM'){
            $rand = rand(88,108);
        } else {
            $rand = rand(100,1600);
        }
        return $rand;
    }

    public function setChanel($chanel) : string{
        return $this->chanel = $chanel;
    }

    public function saveToFavorite($chanel) :string {
        $this->favoriteChannels[] = $chanel;
        return 'Częstotliwość zapisana';
    }

    public function getFavoriteChanels(): array
    {
        return $this->favoriteChannels;
    }

}
