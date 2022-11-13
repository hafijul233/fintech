<?php

namespace Database\Seeders;

use App\Models\Chart;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(...$params)
    {
        $user_id = $params[0] ?? null;

        $charts = [
            '1' => [
                ['code' => '101', 'user_id' => null, 'account_id' => null, 'name' => 'Cash', 'enabled' => true],
                ['code' => '102', 'user_id' => null, 'account_id' => null, 'name' => 'Petty cash', 'enabled' => true],
                ['code' => '103', 'user_id' => null, 'account_id' => null, 'name' => 'Cash equivalents', 'enabled' => true],
                ['code' => '104', 'user_id' => null, 'account_id' => null, 'name' => 'Short-term investments', 'enabled' => true],
                ['code' => '106', 'user_id' => null, 'account_id' => null, 'name' => 'Accounts receivable', 'enabled' => true],
                ['code' => '107', 'user_id' => null, 'account_id' => null, 'name' => 'Allowance for doubtful accounts', 'enabled' => true],
                ['code' => '109', 'user_id' => null, 'account_id' => null, 'name' => 'Interest receivable', 'enabled' => true],
                ['code' => '110', 'user_id' => null, 'account_id' => null, 'name' => 'Rent receivable', 'enabled' => true],
                ['code' => '111', 'user_id' => null, 'account_id' => null, 'name' => 'Notes receivable', 'enabled' => true],
                ['code' => '119', 'user_id' => null, 'account_id' => null, 'name' => 'Merchandise inventory', 'enabled' => true],
                ['code' => '124', 'user_id' => null, 'account_id' => null, 'name' => 'Office supplies', 'enabled' => true],
                ['code' => '128', 'user_id' => null, 'account_id' => null, 'name' => 'Prepaid insurance', 'enabled' => true],
                ['code' => '129', 'user_id' => null, 'account_id' => null, 'name' => 'Prepaid interest', 'enabled' => true],
                ['code' => '131', 'user_id' => null, 'account_id' => null, 'name' => 'Prepaid rent', 'enabled' => true],
                ['code' => '141', 'user_id' => null, 'account_id' => null, 'name' => 'Long-term Investments', 'enabled' => true],
                ['code' => '151', 'user_id' => null, 'account_id' => null, 'name' => 'Automobiles', 'enabled' => true],
                ['code' => '152', 'user_id' => null, 'account_id' => null, 'name' => 'Accumulated depreciation- Automobiles', 'enabled' => true],
                ['code' => '153', 'user_id' => null, 'account_id' => null, 'name' => 'Trucks', 'enabled' => true],
                ['code' => '154', 'user_id' => null, 'account_id' => null, 'name' => 'Accumulated depreciation-Trucks', 'enabled' => true],
                ['code' => '159', 'user_id' => null, 'account_id' => null, 'name' => 'Library', 'enabled' => true],
                ['code' => '160', 'user_id' => null, 'account_id' => null, 'name' => 'Accumulated depreciation-Library', 'enabled' => true],
                ['code' => '161', 'user_id' => null, 'account_id' => null, 'name' => 'Furniture', 'enabled' => true],
                ['code' => '162', 'user_id' => null, 'account_id' => null, 'name' => 'Accumulated depreciation-Furniture', 'enabled' => true],
                ['code' => '163', 'user_id' => null, 'account_id' => null, 'name' => 'Office Equipment', 'enabled' => true],
                ['code' => '164', 'user_id' => null, 'account_id' => null, 'name' => 'Accumulated depreciation-Office equipment', 'enabled' => true],
                ['code' => '169', 'user_id' => null, 'account_id' => null, 'name' => 'Machinery', 'enabled' => true],
                ['code' => '170', 'user_id' => null, 'account_id' => null, 'name' => 'Accumulated depreciation-Machinery', 'enabled' => true],
                ['code' => '175', 'user_id' => null, 'account_id' => null, 'name' => 'Building', 'enabled' => true],
                ['code' => '176', 'user_id' => null, 'account_id' => null, 'name' => 'Accumulated depreciation-Building', 'enabled' => true],
                ['code' => '179', 'user_id' => null, 'account_id' => null, 'name' => 'Land improvements', 'enabled' => true],
                ['code' => '180', 'user_id' => null, 'account_id' => null, 'name' => 'Accumulated depreciation-Land improvements', 'enabled' => true],
                ['code' => '183', 'user_id' => null, 'account_id' => null, 'name' => 'Land', 'enabled' => true],
                ['code' => '185', 'user_id' => null, 'account_id' => null, 'name' => 'Mineral deposit', 'enabled' => true],
                ['code' => '186', 'user_id' => null, 'account_id' => null, 'name' => 'Accumulated depreciation-Mineral deposit', 'enabled' => true],
                ['code' => '191', 'user_id' => null, 'account_id' => null, 'name' => 'Patents', 'enabled' => true],
                ['code' => '192', 'user_id' => null, 'account_id' => null, 'name' => 'Leasehold', 'enabled' => true],
                ['code' => '193', 'user_id' => null, 'account_id' => null, 'name' => 'Franchise', 'enabled' => true],
                ['code' => '194', 'user_id' => null, 'account_id' => null, 'name' => 'Copyrights', 'enabled' => true],
                ['code' => '195', 'user_id' => null, 'account_id' => null, 'name' => 'Leaseholds improvements', 'enabled' => true],
                ['code' => '196', 'user_id' => null, 'account_id' => null, 'name' => 'Licenses', 'enabled' => true],
                ['code' => '197', 'user_id' => null, 'account_id' => null, 'name' => 'Accumulated amortization', 'enabled' => true],
            ],
            '2' => [
                ['code' => '201', 'user_id' => null, 'account_id' => null, 'name' => 'Accounts payable', 'enabled' => true],
                ['code' => '202', 'user_id' => null, 'account_id' => null, 'name' => 'Insurance payable', 'enabled' => true],
                ['code' => '203', 'user_id' => null, 'account_id' => null, 'name' => 'Interest payable', 'enabled' => true],
                ['code' => '204', 'user_id' => null, 'account_id' => null, 'name' => 'Legal fees payable', 'enabled' => true],
                ['code' => '207', 'user_id' => null, 'account_id' => null, 'name' => 'Office salaries payable', 'enabled' => true],
                ['code' => '208', 'user_id' => null, 'account_id' => null, 'name' => 'Rent payable', 'enabled' => true],
                ['code' => '209', 'user_id' => null, 'account_id' => null, 'name' => 'Salaries payable', 'enabled' => true],
                ['code' => '210', 'user_id' => null, 'account_id' => null, 'name' => 'Wages payable', 'enabled' => true],
                ['code' => '211', 'user_id' => null, 'account_id' => null, 'name' => 'Accrued payroll payable', 'enabled' => true],
                ['code' => '214', 'user_id' => null, 'account_id' => null, 'name' => 'Estimated warranty liability', 'enabled' => true],
                ['code' => '215', 'user_id' => null, 'account_id' => null, 'name' => 'Income taxes payable', 'enabled' => true],
                ['code' => '216', 'user_id' => null, 'account_id' => null, 'name' => 'Common dividend payable', 'enabled' => true],
                ['code' => '217', 'user_id' => null, 'account_id' => null, 'name' => 'Preferred dividend payable', 'enabled' => true],
                ['code' => '218', 'user_id' => null, 'account_id' => null, 'name' => 'State unemployment taxes payable', 'enabled' => true],
                ['code' => '219', 'user_id' => null, 'account_id' => null, 'name' => 'Employee federal income taxes payable', 'enabled' => true],
                ['code' => '221', 'user_id' => null, 'account_id' => null, 'name' => 'Employee medical insurance payable', 'enabled' => true],
                ['code' => '222', 'user_id' => null, 'account_id' => null, 'name' => 'Employee retirement program payable', 'enabled' => true],
                ['code' => '223', 'user_id' => null, 'account_id' => null, 'name' => 'Employee union dues payable', 'enabled' => true],
                ['code' => '224', 'user_id' => null, 'account_id' => null, 'name' => 'Federal unemployment taxes payable', 'enabled' => true],
                ['code' => '225', 'user_id' => null, 'account_id' => null, 'name' => 'FICA taxes payable', 'enabled' => true],
                ['code' => '226', 'user_id' => null, 'account_id' => null, 'name' => 'Estimated vacation pay liability', 'enabled' => true],
                ['code' => '230', 'user_id' => null, 'account_id' => null, 'name' => 'Unearned consulting fees', 'enabled' => true],
                ['code' => '231', 'user_id' => null, 'account_id' => null, 'name' => 'Unearned legal fees', 'enabled' => true],
                ['code' => '232', 'user_id' => null, 'account_id' => null, 'name' => 'Unearned property management fees', 'enabled' => true],
                ['code' => '235', 'user_id' => null, 'account_id' => null, 'name' => 'Unearned janitorial revenue', 'enabled' => true],
                ['code' => '238', 'user_id' => null, 'account_id' => null, 'name' => 'Unearned rent', 'enabled' => true],
                ['code' => '240', 'user_id' => null, 'account_id' => null, 'name' => 'Short-term notes payable', 'enabled' => true],
                ['code' => '245', 'user_id' => null, 'account_id' => null, 'name' => 'Notes payable', 'enabled' => true],
                ['code' => '251', 'user_id' => null, 'account_id' => null, 'name' => 'Long-term notes payable', 'enabled' => true],
                ['code' => '253', 'user_id' => null, 'account_id' => null, 'name' => 'Long-term lease liability', 'enabled' => true],
                ['code' => '255', 'user_id' => null, 'account_id' => null, 'name' => 'Bonds payable', 'enabled' => true],
                ['code' => '258', 'user_id' => null, 'account_id' => null, 'name' => 'Deferred income tax liability', 'enabled' => true],
            ],
            '3' => [
                ['code' => '301', 'user_id' => null, 'account_id' => null, 'name' => 'Owner’s Capital', 'enabled' => true],
                ['code' => '302', 'user_id' => null, 'account_id' => null, 'name' => 'Owner’s Withdrawals', 'enabled' => true],
                ['code' => '307', 'user_id' => null, 'account_id' => null, 'name' => 'Common stock, par value', 'enabled' => true],
                ['code' => '308', 'user_id' => null, 'account_id' => null, 'name' => 'Common stock, no par value', 'enabled' => true],
                ['code' => '309', 'user_id' => null, 'account_id' => null, 'name' => 'Common stock, stated value', 'enabled' => true],
                ['code' => '310', 'user_id' => null, 'account_id' => null, 'name' => 'Common stock dividend distributable', 'enabled' => true],
                ['code' => '311', 'user_id' => null, 'account_id' => null, 'name' => 'Paid-in capital in excess of par value, Common stock', 'enabled' => true],
                ['code' => '312', 'user_id' => null, 'account_id' => null, 'name' => 'Paid-in capital in excess of stated value, No-par common stock', 'enabled' => true],
                ['code' => '313', 'user_id' => null, 'account_id' => null, 'name' => 'Paid-in capital from retirement of common stock', 'enabled' => true],
                ['code' => '314', 'user_id' => null, 'account_id' => null, 'name' => 'Paid in capital, Treasury stock', 'enabled' => true],
                ['code' => '315', 'user_id' => null, 'account_id' => null, 'name' => 'Preferred stock', 'enabled' => true],
                ['code' => '316', 'user_id' => null, 'account_id' => null, 'name' => 'Paid-in capital in excess of par value, Preferred stock', 'enabled' => true],
                ['code' => '318', 'user_id' => null, 'account_id' => null, 'name' => 'Retained earnings', 'enabled' => true],
                ['code' => '319', 'user_id' => null, 'account_id' => null, 'name' => 'Cash dividends', 'enabled' => true],
                ['code' => '320', 'user_id' => null, 'account_id' => null, 'name' => 'Stock dividends', 'enabled' => true],
                ['code' => '321', 'user_id' => null, 'account_id' => null, 'name' => 'Treasury stock, Common', 'enabled' => true],
                ['code' => '322', 'user_id' => null, 'account_id' => null, 'name' => 'Unrealized gain-Equity', 'enabled' => true],
                ['code' => '323', 'user_id' => null, 'account_id' => null, 'name' => 'Unrealized loss-Equity', 'enabled' => true],
            ],
            '4' => [
                ['code' => '401', 'user_id' => null, 'account_id' => null, 'name' => 'Fees earned from product one*', 'enabled' => true],
                ['code' => '402', 'user_id' => null, 'account_id' => null, 'name' => 'Fees earned from product two*', 'enabled' => true],
                ['code' => '403', 'user_id' => null, 'account_id' => null, 'name' => 'Service revenue one*', 'enabled' => true],
                ['code' => '404', 'user_id' => null, 'account_id' => null, 'name' => 'Service revenue two*', 'enabled' => true],
                ['code' => '405', 'user_id' => null, 'account_id' => null, 'name' => 'Commissions earned', 'enabled' => true],
                ['code' => '406', 'user_id' => null, 'account_id' => null, 'name' => 'Rent revenue', 'enabled' => true],
                ['code' => '407', 'user_id' => null, 'account_id' => null, 'name' => 'Dividends revenue', 'enabled' => true],
                ['code' => '408', 'user_id' => null, 'account_id' => null, 'name' => 'Earnings from investments in “blank”', 'enabled' => true],
                ['code' => '409', 'user_id' => null, 'account_id' => null, 'name' => 'Interest revenue', 'enabled' => true],
                ['code' => '410', 'user_id' => null, 'account_id' => null, 'name' => 'Sinking fund earnings', 'enabled' => true],
                ['code' => '413', 'user_id' => null, 'account_id' => null, 'name' => 'Sales', 'enabled' => true],
                ['code' => '414', 'user_id' => null, 'account_id' => null, 'name' => 'Sales returns and allowances', 'enabled' => true],
                ['code' => '415', 'user_id' => null, 'account_id' => null, 'name' => 'Sales discounts', 'enabled' => true],
            ],
            '5' => [
                ['code' => '501', 'user_id' => null, 'account_id' => null, 'name' => 'Amortization expense', 'enabled' => true],
                ['code' => '502', 'user_id' => null, 'account_id' => null, 'name' => 'Depletion expense', 'enabled' => true],
                ['code' => '503', 'user_id' => null, 'account_id' => null, 'name' => 'Depreciation expense-Automobiles', 'enabled' => true],
                ['code' => '504', 'user_id' => null, 'account_id' => null, 'name' => 'Depreciation expense-Building', 'enabled' => true],
                ['code' => '505', 'user_id' => null, 'account_id' => null, 'name' => 'Depreciation expense-Furniture', 'enabled' => true],
                ['code' => '506', 'user_id' => null, 'account_id' => null, 'name' => 'Depreciation expense-Land improvements', 'enabled' => true],
                ['code' => '507', 'user_id' => null, 'account_id' => null, 'name' => 'Depreciation expense-Library', 'enabled' => true],
                ['code' => '508', 'user_id' => null, 'account_id' => null, 'name' => 'Depreciation expense-Machinery', 'enabled' => true],
                ['code' => '509', 'user_id' => null, 'account_id' => null, 'name' => 'Depreciation expense-Mineral deposit', 'enabled' => true],
                ['code' => '510', 'user_id' => null, 'account_id' => null, 'name' => 'Depreciation expense-Office equipment', 'enabled' => true],
                ['code' => '511', 'user_id' => null, 'account_id' => null, 'name' => 'Depreciation expense-Trucks', 'enabled' => true],
                ['code' => '520', 'user_id' => null, 'account_id' => null, 'name' => 'Office salaries expense', 'enabled' => true],
                ['code' => '521', 'user_id' => null, 'account_id' => null, 'name' => 'Sales salaries expense', 'enabled' => true],
                ['code' => '522', 'user_id' => null, 'account_id' => null, 'name' => 'Salaries expense', 'enabled' => true],
                ['code' => '523', 'user_id' => null, 'account_id' => null, 'name' => '“Blank” wages expense', 'enabled' => true],
                ['code' => '524', 'user_id' => null, 'account_id' => null, 'name' => 'Employees’ benefits expense', 'enabled' => true],
                ['code' => '525', 'user_id' => null, 'account_id' => null, 'name' => 'Payroll taxes expense', 'enabled' => true],
                ['code' => '530', 'user_id' => null, 'account_id' => null, 'name' => 'Cash over and Short', 'enabled' => true],
                ['code' => '531', 'user_id' => null, 'account_id' => null, 'name' => 'Discounts lost', 'enabled' => true],
                ['code' => '532', 'user_id' => null, 'account_id' => null, 'name' => 'Factoring fee expense', 'enabled' => true],
                ['code' => '533', 'user_id' => null, 'account_id' => null, 'name' => 'Interest expense', 'enabled' => true],
                ['code' => '535', 'user_id' => null, 'account_id' => null, 'name' => 'Insurance expense-Delivery equipment', 'enabled' => true],
                ['code' => '536', 'user_id' => null, 'account_id' => null, 'name' => 'Insurance expense-Office equipment', 'enabled' => true],
                ['code' => '540', 'user_id' => null, 'account_id' => null, 'name' => 'Rent expense', 'enabled' => true],
                ['code' => '541', 'user_id' => null, 'account_id' => null, 'name' => 'Rent expense-Office space', 'enabled' => true],
                ['code' => '542', 'user_id' => null, 'account_id' => null, 'name' => 'Rent expense-Selling space', 'enabled' => true],
                ['code' => '543', 'user_id' => null, 'account_id' => null, 'name' => 'Press rental expense', 'enabled' => true],
                ['code' => '544', 'user_id' => null, 'account_id' => null, 'name' => 'Truck rental expense', 'enabled' => true],
                ['code' => '545', 'user_id' => null, 'account_id' => null, 'name' => '“Blank” rental expense', 'enabled' => true],
                ['code' => '550', 'user_id' => null, 'account_id' => null, 'name' => 'Office supplies expense', 'enabled' => true],
                ['code' => '551', 'user_id' => null, 'account_id' => null, 'name' => 'Store supplies expense', 'enabled' => true],
                ['code' => '552', 'user_id' => null, 'account_id' => null, 'name' => '“Blank” supplies expense', 'enabled' => true],
                ['code' => '555', 'user_id' => null, 'account_id' => null, 'name' => 'Advertising expense', 'enabled' => true],
                ['code' => '556', 'user_id' => null, 'account_id' => null, 'name' => 'Bad debts expense', 'enabled' => true],
                ['code' => '557', 'user_id' => null, 'account_id' => null, 'name' => 'Blueprinting expense', 'enabled' => true],
                ['code' => '558', 'user_id' => null, 'account_id' => null, 'name' => 'Boat expense', 'enabled' => true],
                ['code' => '559', 'user_id' => null, 'account_id' => null, 'name' => 'Collection expense', 'enabled' => true],
                ['code' => '561', 'user_id' => null, 'account_id' => null, 'name' => 'Concessions expense', 'enabled' => true],
                ['code' => '562', 'user_id' => null, 'account_id' => null, 'name' => 'Credit card expense', 'enabled' => true],
                ['code' => '563', 'user_id' => null, 'account_id' => null, 'name' => 'Delivery expense', 'enabled' => true],
                ['code' => '564', 'user_id' => null, 'account_id' => null, 'name' => 'Dumping expense', 'enabled' => true],
                ['code' => '566', 'user_id' => null, 'account_id' => null, 'name' => 'Equipment expense', 'enabled' => true],
                ['code' => '567', 'user_id' => null, 'account_id' => null, 'name' => 'Food and drinks expense', 'enabled' => true],
                ['code' => '568', 'user_id' => null, 'account_id' => null, 'name' => 'Gas and oil expense', 'enabled' => true],
                ['code' => '571', 'user_id' => null, 'account_id' => null, 'name' => 'General and administrative expense', 'enabled' => true],
                ['code' => '572', 'user_id' => null, 'account_id' => null, 'name' => 'Janitorial expense', 'enabled' => true],
                ['code' => '573', 'user_id' => null, 'account_id' => null, 'name' => 'Legal fees expense', 'enabled' => true],
                ['code' => '574', 'user_id' => null, 'account_id' => null, 'name' => 'Mileage expense', 'enabled' => true],
                ['code' => '576', 'user_id' => null, 'account_id' => null, 'name' => 'Miscellaneous expense', 'enabled' => true],
                ['code' => '577', 'user_id' => null, 'account_id' => null, 'name' => 'Mower and tool expense', 'enabled' => true],
                ['code' => '578', 'user_id' => null, 'account_id' => null, 'name' => 'Operating expense', 'enabled' => true],
                ['code' => '579', 'user_id' => null, 'account_id' => null, 'name' => 'Organization expense', 'enabled' => true],
                ['code' => '580', 'user_id' => null, 'account_id' => null, 'name' => 'Permits expense', 'enabled' => true],
                ['code' => '581', 'user_id' => null, 'account_id' => null, 'name' => 'Postage expense', 'enabled' => true],
                ['code' => '582', 'user_id' => null, 'account_id' => null, 'name' => 'Property taxes expense', 'enabled' => true],
                ['code' => '583', 'user_id' => null, 'account_id' => null, 'name' => 'Repairs expense', 'enabled' => true],
                ['code' => '584', 'user_id' => null, 'account_id' => null, 'name' => 'Selling expense', 'enabled' => true],
                ['code' => '585', 'user_id' => null, 'account_id' => null, 'name' => 'Telephone expense', 'enabled' => true],
                ['code' => '587', 'user_id' => null, 'account_id' => null, 'name' => 'Travel and entertainment expense', 'enabled' => true],
                ['code' => '590', 'user_id' => null, 'account_id' => null, 'name' => 'Utilities expense', 'enabled' => true],
                ['code' => '591', 'user_id' => null, 'account_id' => null, 'name' => 'Warranty expense', 'enabled' => true],
                ['code' => '595', 'user_id' => null, 'account_id' => null, 'name' => 'Income taxes expense', 'enabled' => true],
            ],
        ];

        try {
            DB::beginTransaction();
            foreach ($charts as $account_id => $chart) {
                foreach ($chart as $entry) {
                    $entry['user_id'] = $user_id;
                    $entry['account_id'] = $account_id;
                    Chart::create($entry);
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->command->error($exception->getMessage());
        }
    }
}
