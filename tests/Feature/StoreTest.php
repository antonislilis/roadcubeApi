<?php

namespace Tests\Feature;

use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\StoreStoreSearchRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use DatabaseMigrations;
    private StoreStoreRequest $storeStoreRequest;
    private StoreStoreSearchRequest $storeStoreSearchRequest;
    private array $store;

    protected function setUp(): void
    {
        parent::setUp();

        $this->storeStoreRequest = new StoreStoreRequest();
        $this->storeStoreSearchRequest = new StoreStoreSearchRequest();

        $this->store = [
            "store_id" => 1,
            "parent_id" => null,
            "store_type_id" => 1,
            "name" => "Roadcube",
            "app_name" => "Roadcube",
            "address" => "Αγιών Αναργύρων 5, Γαλάτσι",
            "zip" => "11146",
            "email" => "lexi.cassin@hoppe.com",
            "lat" => "34.01073",
            "lon" => "23.74956",
        ];

        $this->artisan('db:seed');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetAllDataResponseContainsStore()
    {
        //Disable logging request
        $this->app->instance('middleware.disable', true);

        $response = $this->getJson(route('strore.all'));
        //dd($response->json());
        // test if we have a specific store in database
        $this->assertArrayHasKey('store_id', $response->json()[0]);

        // test if store database is not empty
        $this->assertNotEmpty(
            $response->json(),
            "store collection is not empty"
        );

        // test status
        $response->assertStatus(200);
    }

    public function testStoreStoreRequestRules()
    {
        $this->assertEquals([
            'parent_id' => 'in:1,2,null|nullable',
            'store_type_id' => 'numeric|required',
            'name' => 'string|max:120|min:3|required',
            'app_name' => 'string|max:200|min:3|required',
            'address' => 'string|max:300|min:3|required',
            'zip' => 'digits:5|max:15|required',
            'email' => 'required|email',
            'lat' => 'numeric',
            'lon' => 'numeric',
        ],
            $this->storeStoreRequest->rules()
        );
    }

    public function testStoreStoreSearchRequestRules()
    {
        $this->assertEquals([
            'name' => 'string|max:120|min:3',
            'app_name' => 'string|max:200|min:3',
            'address' => 'string|max:300|min:3',
            'lat' => 'numeric|required_with:lon,radius',
            'lon' => 'numeric|required_with:lat,radius',
            'radius' => 'numeric|required_with:lat,lon',
        ],
            $this->storeStoreSearchRequest->rules()
        );
    }

    public function testStoreSearchWithNameFilter()
    {
        $name = 'Roadcube';
        $response = $this->json('GET', route('store.search'), ['name' => $name]);

        $this->assertContainsEquals($this->store, $response->json());
        $response->assertStatus(200);
    }

    public function testStoreSearchWithAddressFilter()
    {
        $address = 'Αγιών Αναργύρων';
        $response = $this->json('GET', route('store.search'), ['address' => $address]);

        $this->assertContainsEquals($this->store, $response->json());
        $response->assertStatus(200);
    }

    public function testStoreSearchWithAppNameFilter()
    {
        $appName = 'Roadcube';
        $response = $this->json('GET', route('store.search'), ['app_name' => $appName]);

        $this->assertContainsEquals($this->store, $response->json());
        $response->assertStatus(200);
    }

   /* public function testStoreSearchWithCoordinatesFilter()
    {
        $lat = 34.0107300;
        $lon = 23.7495600;
        $radius = 200;
        $response = $this->json('GET', route('store.search'), [
            'lat' => $lat,
            'lon' => $lon,
            'radius' => $radius,
        ]);

        $this->assertContains($this->store, $response->json());
        $response->assertStatus(200);
    }*/

    public function testStoreSearchWithMissingCoordinatesFilter()
    {
        $lon = 23.7495600;
        $radius = 200;
        $response = $this->json('GET', route('store.search'), [
            'lon' => $lon,
            'radius' => $radius,
        ]);

        $response->assertJsonStructure(['errors' => ['lat']]);
        $response->assertStatus(422);
    }

    public function testStoreSearchWithWrongCoordinatesFilter()
    {
        $name = null; // will pass
        $lon = 'abc';
        $radius = '34'; // will pass
        $response = $this->json('GET', route('store.search'), [
            'name' => $name,
            'lon' => $lon,
            'radius' => $radius,
        ]);

        $response->assertJsonStructure(['errors' => ['lat', 'lon']]);
        $response->assertStatus(422);
    }
}
