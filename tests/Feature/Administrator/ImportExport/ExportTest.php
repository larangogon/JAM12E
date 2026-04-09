<?php

namespace Tests\Feature\Administrator\ImportExport;

use App\Entities\Cart;
use App\Entities\User;
use App\Exports\OrdersExport;
use App\Exports\ProductsExport;
use App\Exports\UsersExport;
use Database\Seeders\PermissionsTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExportTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        $this->seed(PermissionsTableSeeder::class);
        $this->user = factory(User::class)->create();

        $this->user->assignRole('Administrator');

        $this->cart = new Cart();
        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    /**
     * @test
     */
    public function userCanDownloadProductsExport()
    {
        Excel::fake();

        $this->actingAs($this->user, 'web')->get('export-products');

        Excel::assertDownloaded('products.xlsx', function (ProductsExport $export) {
            return true;
        });

        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * @test
     */
    public function userCanDownloadUsersExport()
    {
        Excel::fake();

        $this->actingAs($this->user, 'web')
            ->get('export-users');

        Excel::assertDownloaded('users.xlsx', function (UsersExport $export) {
            return true;
        });

        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * @test
     */
    public function userDanDownloadOrdersExport()
    {
        Excel::fake();

        $this->actingAs($this->user, 'web')->get('export-orders');

        Excel::assertDownloaded('orders.xlsx', function (OrdersExport $export) {
            return true;
        });

        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * @test
     */
    public function userReporteGeneralExcel()
    {
        $response = $this->actingAs($this->user, 'web')->get('report-general-export');

        $response
            ->assertSessionHas('success', 'El reporte se ha generado, verifica tu correo!')
            ->assertStatus(302);

        $name = date('Y-m-d-H-i') . 'reporte.xlsx';

        $this->assertDatabaseHas('reports', [
            'created_by' => auth()->user()->id,
            'file' => $name,
            'type' => 'Excel',
            'name' => 'Reporte en excel',
        ]);

        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * @test
     */
    public function userReporteProductsExcel()
    {
        $response = $this->actingAs($this->user, 'web')
            ->get('report-product-export');

        $response
            ->assertSessionHas('success', 'El reporte se ha generado, verifica tu correo!')
            ->assertStatus(302);

        $name = date('Y-m-d-H-i') . 'reporte.xlsx';

        $this->assertDatabaseHas('reports', [
            'created_by' => auth()->user()->id,
            'file' => $name,
            'type' => 'Excel',
            'name' => 'Reporte en excel de productos',
        ]);

        $this->assertAuthenticatedAs($this->user);
    }
}
