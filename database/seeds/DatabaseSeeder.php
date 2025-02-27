<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Model::unguard();
        $this->call([
            RoleTableSeeder::class,
            PermissionTableSeeder::class,
            UserTableSeeder::class,
            RoleUserTableSeeder::class,
            PermissionRoleTableSeeder::class,


            //            AddressTableSeeder::class,
            DeviceTableSeeder::class,
            InterestTableSeeder::class,
            InterestUserTableSeeder::class,
            // VitcoinTableSeeder::class,
            //            BankAccountTableSeeder::class,

            CategoryTableSeeder::class,
            ProductTableSeeder::class,
            CategoryProductTableSeeder::class,
            ProductWallTableSeeder::class,
            VendingProductTableSeeder::class,
            ShopProductTableSeeder::class,
            ShopProductInventoryTableSeeder::class,
            LEDTableSeeder::class,

            TagTableSeeder::class,

            ProductTagTableSeeder::class,
            AdvertisementTableSeeder::class,
            AdvertisementTagTableSeeder::class,

            LockerTableSeeder::class,

            TransactionTableSeeder::class,
            //            LockerTransactionTableSeeder::class,
            ProductTransactionTableSeeder::class,
            //            RemittanceTransactionTableSeeder::class,

            InsuranceTableSeeder::class,
            StockTableSeeder::class,
            MissionTableSeeder::class,
            VitcoinSeeder::class,
        ]);
        // Model::reguard();
    }
}
