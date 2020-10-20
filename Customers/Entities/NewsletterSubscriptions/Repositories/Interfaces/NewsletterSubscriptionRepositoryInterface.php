<?php

namespace Modules\Customers\Entities\NewsletterSubscriptions\Repositories\Interfaces;

use Modules\Customers\Entities\NewsletterSubscriptions\NewsletterSubscription;
use Illuminate\Database\Eloquent\Collection;


interface NewsletterSubscriptionRepositoryInterface
{
    public function listNewsletterSubscriptions($totalView);

    public function createNewsletterSubscription(array $params): NewsletterSubscription;

    public function deleteNewsletterSubscription(): bool;
}
