<?php
//SMALL_MODEL , MODEL , PLURAL_MODEL
namespace Tests\Feature;

use BasicDashboard\Foundations\Domain\EducationEligibleScores\EducationEligibleScore;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EducationEligibleScoreFeatureTest extends TestCase
{
    use DatabaseTransactions, TestingRequirement;

    const ROUTE = "/????";
    const TABLE = "????";

    //UnAuthorized Test
    public function test_prevent_non_logged_users_to_access_educationEligibleScore_routes(): void
    {
        $educationEligibleScore = EducationEligibleScore::first()->toArray();;
        $educationEligibleScoreList = $this->get(self::ROUTE);
        $educationEligibleScoreCreate = $this->post(self::ROUTE);
        $educationEligibleScoreUpdate = $this->put(self::ROUTE . "/" . $educationEligibleScore['id']);
        $educationEligibleScoreEdit = $this->get(self::ROUTE . "/" . $educationEligibleScore['id'] . "/edit");
        $educationEligibleScoreDelete = $this->delete(self::ROUTE . "/" . $educationEligibleScore['id']);

        $educationEligibleScoreList->assertStatus(302);
        $educationEligibleScoreCreate->assertStatus(302);
        $educationEligibleScoreUpdate->assertStatus(302);
        $educationEligibleScoreEdit->assertStatus(302);
        $educationEligibleScoreDelete->assertStatus(302);
    }

    //Store Validation Test
    public function test_educationEligibleScore_cannot_store_without_name(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $request = $this->prepareData("");
        $response = $this->post(self::ROUTE, $request);
        $response->assertStatus(302);
    }


    //Store Process
    public function test_store_process_of_educationEligibleScore(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $totalNumberOfEducationEligibleScoreBefore = EducationEligibleScore::count();
        $request = $this->prepareData("Test Name");
        $this->post(self::ROUTE, $request);
        $totalNumberOfEducationEligibleScoreAfter = EducationEligibleScore::count();
        $this->assertEquals($totalNumberOfEducationEligibleScoreBefore + 1, $totalNumberOfEducationEligibleScoreAfter);
        $this->assertDatabaseHas(self::TABLE, $this->prepareDataForCheck($request));
    }

    //Listing Process
    public function test_list_of_educationEligibleScore(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $response = $this->get(self::ROUTE);
        $response->assertStatus(200);
    }

    //Update Process
    public function test_update_process_of_educationEligibleScore(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $oldData = EducationEligibleScore::Create($this->prepareData("Test Name"));
        $totalNumberOfEducationEligibleScoreBefore = EducationEligibleScore::count();
        $updateData = $this->prepareData("Update Name");
        $this->put(self::ROUTE . "/" . customEncoder($oldData->id), $updateData);
        $totalNumberOfEducationEligibleScoreAfter = EducationEligibleScore::count();
        $this->assertEquals($totalNumberOfEducationEligibleScoreBefore, $totalNumberOfEducationEligibleScoreAfter);
        $this->assertDatabaseHas(self::TABLE, $this->prepareDataForCheck($updateData));
    }

    //Delete Validation
    public function test_ceducationEligibleScore_cannot_delete_without_id(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $deleteData = EducationEligibleScore::first();
        $request = $this->prepareDataForDelete('');
        $response = $this->delete(self::ROUTE . '/' . $deleteData, $request);
        $response->assertStatus(302);
    }

    //Delete Process
    public function test_delete_process_of_educationEligibleScore(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $totalNumberOfEducationEligibleScoreBefore = EducationEligibleScore::Count();
        $deleteData = EducationEligibleScore::first();
        $request = $this->prepareDataForDelete($deleteData->id);
        $this->delete(self::ROUTE . '/' . $deleteData, $request);
        $totalNumberOfEducationEligibleScoreAfter = EducationEligibleScore::Count();
        $this->assertEquals($totalNumberOfEducationEligibleScoreBefore, $totalNumberOfEducationEligibleScoreAfter + 1);
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
