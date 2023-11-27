<?php

interface Subscription
{
    public function price();
    public function description();
}

class BasicSubscription implements Subscription
{
    public function price()
    {
        return 5;
    }

    public function description()
    {
        return 'Basic subscription';
    }
}

abstract class SubscriptionFeature implements Subscription
{
    protected $subscription;

    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    abstract public function price();
    abstract public function description();
}

class AdditionalSpaceFeature extends SubscriptionFeature
{
    public function price()
    {
        return $this->subscription->price() + 3;
    }

    public function description()
    {
        return $this->subscription->description() . ' + Additional space';
    }
}

class SupportFeature extends SubscriptionFeature
{
    public function price()
    {
        return $this->subscription->price() + 1;
    }

    public function description()
    {
        return $this->subscription->description() . ' + Support';
    }
}

$subscription = new BasicSubscription;
$subscription = new AdditionalSpaceFeature($subscription);
$subscription = new SupportFeature($subscription);

echo $subscription->price();