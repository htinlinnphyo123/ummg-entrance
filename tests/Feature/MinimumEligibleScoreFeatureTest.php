<?php
//SMALL_MODEL , MODEL , PLURAL_MODEL
namespace Tests\Feature;

use BasicDashboard\Foundations\Domain\MinimumEligibleScore\MinimumEligibleScore;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MinimumEligibleScoreFeatureTest extends TestCase
{
    use DatabaseTransactions, TestingRequirement;

    const ROUTE = "/????";
    const TABLE = "????";

    //UnAuthorized Test
    public function test_prevent_non_logged_users_to_access_minimumEligibleScore_routes(): void
    {
        $minimumEligibleScore = MinimumEligibleScore::first()->toArray();;
        $minimumEligibleScoreList = $this->get(self::ROUTE);
        $minimumEligibleScoreCreate = $this->post(self::ROUTE);
        $minimumEligibleScoreUpdate = $this->put(self::ROUTE . "/" . $minimumEligibleScore['id']);
        $minimumEligibleScoreEdit = $this->get(self::ROUTE . "/" . $minimumEligibleScore['id'] . "/edit");
        $minimumEligibleScoreDelete = $this->delete(self::ROUTE . "/" . $minimumEligibleScore['id']);

        $minimumEligibleScoreList->assertStatus(302);
        $minimumEligibleScoreCreate->assertStatus(302);
        $minimumEligibleScoreUpdate->assertStatus(302);
        $minimumEligibleScoreEdit->assertStatus(302);
        $minimumEligibleScoreDelete->assertStatus(302);
    }

    //Store Validation Test
    public function test_minimumEligibleScore_cannot_store_without_name(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $request = $this->prepareData("");
        $response = $this->post(self::ROUTE, $request);
        $response->assertStatus(302);
    }


    //Store Process
    public function test_store_process_of_minimumEligibleScore(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $totalNumberOfMinimumEligibleScoreBefore = MinimumEligibleScore::count();
        $request = $this->prepareData("Test Name");
        $this->post(self::ROUTE, $request);
        $totalNumberOfMinimumEligibleScoreAfter = MinimumEligibleScore::count();
        $this->assertEquals($totalNumberOfMinimumEligibleScoreBefore + 1, $totalNumberOfMinimumEligibleScoreAfter);
        $this->assertDatabaseHas(self::TABLE, $this->prepareDataForCheck($request));
    }

    //Listing Process
    public function test_list_of_minimumEligibleScore(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $response = $this->get(self::ROUTE);
        $response->assertStatus(200);
    }

    //Update Process
    public function test_update_process_of_minimumEligibleScore(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $oldData = MinimumEligibleScore::Create($this->prepareData("Test Name"));
        $totalNumberOfMinimumEligibleScoreBefore = MinimumEligibleScore::count();
        $updateData = $this->prepareData("Update Name");
        $this->put(self::ROUTE . "/" . customEncoder($oldData->id), $updateData);
        $totalNumberOfMinimumEligibleScoreAfter = MinimumEligibleScore::count();
        $this->assertEquals($totalNumberOfMinimumEligibleScoreBefore, $totalNumberOfMinimumEligibleScoreAfter);
        $this->assertDatabaseHas(self::TABLE, $this->prepareDataForCheck($updateData));
    }

    //Delete Validation
    public function test_cminimumEligibleScore_cannot_delete_without_id(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $deleteData = MinimumEligibleScore::first();
        $request = $this->prepareDataForDelete('');
        $response = $this->delete(self::ROUTE . '/' . $deleteData, $request);
        $response->assertStatus(302);
    }

    //Delete Process
    public function test_delete_process_of_minimumEligibleScore(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $totalNumberOfMinimumEligibleScoreBefore = MinimumEligibleScore::Count();
        $deleteData = MinimumEligibleScore::first();
        $request = $this->prepareDataForDelete($deleteData->id);
        $this->delete(self::ROUTE . '/' . $deleteData, $request);
        $totalNumberOfMinimumEligibleScoreAfter = MinimumEligibleScore::Count();
        $this->assertEquals($totalNumberOfMinimumEligibleScoreBefore, $totalNumberOfMinimumEligibleScoreAfter + 1);
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
