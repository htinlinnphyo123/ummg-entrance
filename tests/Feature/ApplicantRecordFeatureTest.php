<?php
//SMALL_MODEL , MODEL , PLURAL_MODEL
namespace Tests\Feature;

use BasicDashboard\Foundations\Domain\ApplicantRecord\ApplicantRecord;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ApplicantRecordFeatureTest extends TestCase
{
    use DatabaseTransactions, TestingRequirement;

    const ROUTE = "/????";
    const TABLE = "????";

    //UnAuthorized Test
    public function test_prevent_non_logged_users_to_access_applicantRecord_routes(): void
    {
        $applicantRecord = ApplicantRecord::first()->toArray();;
        $applicantRecordList = $this->get(self::ROUTE);
        $applicantRecordCreate = $this->post(self::ROUTE);
        $applicantRecordUpdate = $this->put(self::ROUTE . "/" . $applicantRecord['id']);
        $applicantRecordEdit = $this->get(self::ROUTE . "/" . $applicantRecord['id'] . "/edit");
        $applicantRecordDelete = $this->delete(self::ROUTE . "/" . $applicantRecord['id']);

        $applicantRecordList->assertStatus(302);
        $applicantRecordCreate->assertStatus(302);
        $applicantRecordUpdate->assertStatus(302);
        $applicantRecordEdit->assertStatus(302);
        $applicantRecordDelete->assertStatus(302);
    }

    //Store Validation Test
    public function test_applicantRecord_cannot_store_without_name(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $request = $this->prepareData("");
        $response = $this->post(self::ROUTE, $request);
        $response->assertStatus(302);
    }


    //Store Process
    public function test_store_process_of_applicantRecord(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $totalNumberOfApplicantRecordBefore = ApplicantRecord::count();
        $request = $this->prepareData("Test Name");
        $this->post(self::ROUTE, $request);
        $totalNumberOfApplicantRecordAfter = ApplicantRecord::count();
        $this->assertEquals($totalNumberOfApplicantRecordBefore + 1, $totalNumberOfApplicantRecordAfter);
        $this->assertDatabaseHas(self::TABLE, $this->prepareDataForCheck($request));
    }

    //Listing Process
    public function test_list_of_applicantRecord(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $response = $this->get(self::ROUTE);
        $response->assertStatus(200);
    }

    //Update Process
    public function test_update_process_of_applicantRecord(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $oldData = ApplicantRecord::Create($this->prepareData("Test Name"));
        $totalNumberOfApplicantRecordBefore = ApplicantRecord::count();
        $updateData = $this->prepareData("Update Name");
        $this->put(self::ROUTE . "/" . customEncoder($oldData->id), $updateData);
        $totalNumberOfApplicantRecordAfter = ApplicantRecord::count();
        $this->assertEquals($totalNumberOfApplicantRecordBefore, $totalNumberOfApplicantRecordAfter);
        $this->assertDatabaseHas(self::TABLE, $this->prepareDataForCheck($updateData));
    }

    //Delete Validation
    public function test_capplicantRecord_cannot_delete_without_id(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $deleteData = ApplicantRecord::first();
        $request = $this->prepareDataForDelete('');
        $response = $this->delete(self::ROUTE . '/' . $deleteData, $request);
        $response->assertStatus(302);
    }

    //Delete Process
    public function test_delete_process_of_applicantRecord(): void
    {
        $this->AuthenticateUserForCustomMiddleware();
        $totalNumberOfApplicantRecordBefore = ApplicantRecord::Count();
        $deleteData = ApplicantRecord::first();
        $request = $this->prepareDataForDelete($deleteData->id);
        $this->delete(self::ROUTE . '/' . $deleteData, $request);
        $totalNumberOfApplicantRecordAfter = ApplicantRecord::Count();
        $this->assertEquals($totalNumberOfApplicantRecordBefore, $totalNumberOfApplicantRecordAfter + 1);
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
