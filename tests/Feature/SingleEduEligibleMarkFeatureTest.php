<?php
//SMALL_MODEL , MODEL , PLURAL_MODEL
namespace Tests\Feature;

use BasicDashboard\Foundations\Domain\SingleEduEligibleMarks\SingleEduEligibleMark;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SingleEduEligibleMarkFeatureTest extends TestCase
{
    use DatabaseTransactions, TestingRequirement;

    const ROUTE = "/????";
    const TABLE = "????";

    //UnAuthorized Test
    public function test_prevent_non_logged_users_to_access_singleEduEligibleMark_routes(): void
    {
        $singleEduEligibleMark = SingleEduEligibleMark::first()->toArray();;
        $singleEduEligibleMarkList = $this->get(self::ROUTE);
        $singleEduEligibleMarkCreate = $this->post(self::ROUTE);
        $singleEduEligibleMarkUpdate = $this->put(self::ROUTE . "/" . $singleEduEligibleMark['id']);
        $singleEduEligibleMarkEdit = $this->get(self::ROUTE . "/" . $singleEduEligibleMark['id'] . "/edit");
        $singleEduEligibleMarkDelete = $this->delete(self::ROUTE . "/" . $singleEduEligibleMark['id']);

        $singleEduEligibleMarkList->assertStatus(302);
        $singleEduEligibleMarkCreate->assertStatus(302);
        $singleEduEligibleMarkUpdate->assertStatus(302);
        $singleEduEligibleMarkEdit->assertStatus(302);
        $singleEduEligibleMarkDelete->assertStatus(302);
    }

    //Store Validation Test
    public function test_singleEduEligibleMark_cannot_store_without_name(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $request = $this->prepareData("");
        $response = $this->post(self::ROUTE, $request);
        $response->assertStatus(302);
    }


    //Store Process
    public function test_store_process_of_singleEduEligibleMark(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $totalNumberOfSingleEduEligibleMarkBefore = SingleEduEligibleMark::count();
        $request = $this->prepareData("Test Name");
        $this->post(self::ROUTE, $request);
        $totalNumberOfSingleEduEligibleMarkAfter = SingleEduEligibleMark::count();
        $this->assertEquals($totalNumberOfSingleEduEligibleMarkBefore + 1, $totalNumberOfSingleEduEligibleMarkAfter);
        $this->assertDatabaseHas(self::TABLE, $this->prepareDataForCheck($request));
    }

    //Listing Process
    public function test_list_of_singleEduEligibleMark(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $response = $this->get(self::ROUTE);
        $response->assertStatus(200);
    }

    //Update Process
    public function test_update_process_of_singleEduEligibleMark(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $oldData = SingleEduEligibleMark::Create($this->prepareData("Test Name"));
        $totalNumberOfSingleEduEligibleMarkBefore = SingleEduEligibleMark::count();
        $updateData = $this->prepareData("Update Name");
        $this->put(self::ROUTE . "/" . customEncoder($oldData->id), $updateData);
        $totalNumberOfSingleEduEligibleMarkAfter = SingleEduEligibleMark::count();
        $this->assertEquals($totalNumberOfSingleEduEligibleMarkBefore, $totalNumberOfSingleEduEligibleMarkAfter);
        $this->assertDatabaseHas(self::TABLE, $this->prepareDataForCheck($updateData));
    }

    //Delete Validation
    public function test_csingleEduEligibleMark_cannot_delete_without_id(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $deleteData = SingleEduEligibleMark::first();
        $request = $this->prepareDataForDelete('');
        $response = $this->delete(self::ROUTE . '/' . $deleteData, $request);
        $response->assertStatus(302);
    }

    //Delete Process
    public function test_delete_process_of_singleEduEligibleMark(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $totalNumberOfSingleEduEligibleMarkBefore = SingleEduEligibleMark::Count();
        $deleteData = SingleEduEligibleMark::first();
        $request = $this->prepareDataForDelete($deleteData->id);
        $this->delete(self::ROUTE . '/' . $deleteData, $request);
        $totalNumberOfSingleEduEligibleMarkAfter = SingleEduEligibleMark::Count();
        $this->assertEquals($totalNumberOfSingleEduEligibleMarkBefore, $totalNumberOfSingleEduEligibleMarkAfter + 1);
    }

    //Private Section
    private function prepareData(string $param1): array
    {
        return [
            "name" => $param1,
        ];
    }

    private function prepareDataForCheck(array $data): array
    {
        return [
            'name' => isset($data['name']) ? $data['name'] : '',
        ];
    }

    private function prepareDataForDelete(string $id): array
    {
        return [
            'id' => $id != '' ? customEncoder($id) : '',
        ];
    }

}
