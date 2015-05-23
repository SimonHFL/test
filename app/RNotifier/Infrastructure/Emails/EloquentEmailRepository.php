<?php namespace App\RNotifier\Infrastructure\Emails;


use App\RNotifier\Domain\Emails\Email;
use App\RNotifier\Domain\Emails\EmailRepositoryInterface;
use App\RNotifier\Domain\Shops\Shop;

class EloquentEmailRepository implements EmailRepositoryInterface{

    public function retrievePaginatedForShop($shop)
    {
        $emails = $shop->emails()->paginate(10);

        return $emails;
    }

    public function delete($id, $shopId)
    {
        return Shop::findOrFail($shopId)
            ->emails()
            ->delete($id);
    }

    public function save(Email $email, $shopId)
    {
        return Shop::findOrFail($shopId)
            ->emails()
            ->save($email);
    }
}