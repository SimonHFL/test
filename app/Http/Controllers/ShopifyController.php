<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Config;
use phpish\shopify;
use App\RNotifier\Domain\Products\ProductRepositoryInterface;


class shopifyController extends Controller {

	private $productRepository;

	function __construct(ProductRepositoryInterface $productRepository)
	{
		$this->productRepository = $productRepository;
	}


	public function shop()
	{
		$apiKey = Config::get('RNotifier.apiKey');
		$password = Config::get('RNotifier.password');
		$shopName = Config::get('RNotifier.shopName');

		$shopify = shopify\client($shopName, $apiKey, $password, true);
		try
		{
			# Making an API request can throw an exception
			$shop = $shopify('GET /admin/shop.json');
			print_r($shop);
		}
		catch (shopify\ApiException $e)
		{
			# HTTP status code was >= 400 or response contained the key 'errors'
			echo $e;
			print_R($e->getRequest());
			print_R($e->getResponse());
		}
		catch (shopify\CurlException $e)
		{
			# cURL error
			echo $e;
			print_R($e->getRequest());
			print_R($e->getResponse());
		}
	}

	public function product()
	{

		dd($this->productRepository->retrieve());

	}

}
