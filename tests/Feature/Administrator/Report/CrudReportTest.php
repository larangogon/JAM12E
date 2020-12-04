<?php

namespace Tests\Feature\Administrator\Report;

use App\Entities\Cart;
use App\Entities\Order;
use App\Entities\Report;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrudReportTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();

        $this->seed(\PermissionsTableSeeder::class);
        $this->user = factory(User::class)->create(
            ['id' => 1,]
        );

        $this->user->assignRole('Administrator');

        $this->cart =  new Cart();
        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    public function testIndex(): void
    {
        $response = $this->actingAs($this->user, 'web')
            ->get(route('reports.index'));

        $response
            ->assertStatus(200)
            ->assertViewIs('reports.index');
    }

    public function testReportGeneral(): void
    {
        $response = $this->actingAs($this->user, 'web')
            ->get(route('reportGeneral'));

        $response
            ->assertStatus(302);
    }

    public function testReportOrdersFechaNull(): void
    {
        $fechaInicio = date('Y-m-d', strtotime('2020-11-21'));

        $fechaFinal = date('Y-m-d', strtotime('2020-11-22'));

        $status = 'APPROVED';

        $response = $this->actingAs($this->user, 'web')
            ->post(route('reportOrders'), [
                    'fechaFinal'  => $fechaInicio,
                    'fechaInicio' => $fechaFinal,
                    'status'      => $status,
                ]);

        $response
            ->assertSessionHas('success', 'La fecha inicial es mayor que la final !')
            ->assertStatus(302);
    }

    public function testReportOrders(): void
    {
        $fechaInicio = date('Y-m-d', strtotime('2020-12-02'));

        $fechaFinal = date('Y-m-d', strtotime('2020-12-04'));

        $status = 'APPROVED';

        $response = $this->actingAs($this->user, 'web')
            ->post(route('reportOrders'), [
                'fechaFinal'  => $fechaInicio,
                'fechaInicio' => $fechaFinal,
                'status'      => $status,
            ]);

        $response
            ->assertSessionHas('success', 'La fecha inicial es mayor que la final !')
            ->assertStatus(302);
    }

    public function testDestroy(): void
    {
        $report = Report::create([
            'created_by' => 1,
            'file' => 'Enviado_A_johannitaarango2@gmail.com',
            'type' => 'Excel'
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('reports.destroy', $report->id), [
                'id' => $report->id
            ]);

        $response
            ->assertStatus(302);

        $this->assertDatabaseMissing('reports', [
            'id'  => $report->id,
        ]);
    }
}
