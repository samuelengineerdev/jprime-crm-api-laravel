<?php

namespace Database\Seeders;

use App\Models\ClientAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientAccount::create([
            'name' => 'Alex',
            'phone' => '8293564877',
            'residential_address' => '123 Main Street, Cityville, State',
            'company_name' => 'ABC Corporation',
            'company_address' => '456 Business Avenue, Townsville, State',
            'type_of_company' => 'Public Limited Company',
            'notes' => 'This client prefers email communication and has shown interest in our new product offerings.',
        ]);

        ClientAccount::create([
            'name' => 'Willi',
            'phone' => '8296751255',
            'residential_address' => '789 Oak Lane, Suburbia, State',
            'company_name' => 'XYZ Ltd.',
            'company_address' => '101 Enterprise Street, Metropolis, State',
            'type_of_company' => 'Private Limited Company',
            'notes' => 'This client prefers phone communication and has expressed interest in our consulting services.',
        ]);

        ClientAccount::create([
            'name' => 'John Doe',
            'phone' => '1234567890',
            'residential_address' => '456 Pine Street, Suburbia, State',
            'company_name' => 'Doe Enterprises',
            'company_address' => '789 Business Avenue, Citytown, State',
            'type_of_company' => 'Sole Proprietorship',
            'notes' => 'This client prefers in-person meetings and is interested in our IT services.',
        ]);

        ClientAccount::create([
            'name' => 'Emma Smith',
            'phone' => '9876543210',
            'residential_address' => '567 Maple Lane, Villagetown, State',
            'company_name' => 'Smith Industries',
            'company_address' => '890 Commerce Street, Megacity, State',
            'type_of_company' => 'Limited Liability Company',
            'notes' => 'Emma is a long-time customer and frequently orders our products online.',
        ]);

        ClientAccount::create([
            'name' => 'Michael Johnson',
            'phone' => '5551234567',
            'residential_address' => '789 Oak Street, Countryside, State',
            'company_name' => 'Johnson & Sons',
            'company_address' => '123 Market Avenue, Townsville, State',
            'type_of_company' => 'Family Business',
            'notes' => 'Michael has attended our recent webinar and is interested in our financial advisory services.',
        ]);

        ClientAccount::create([
            'name' => 'Sophia Martinez',
            'phone' => '5557890123',
            'residential_address' => '789 Cedar Lane, Townsville, State',
            'company_name' => 'Martinez Innovations',
            'company_address' => '234 Tech Street, Cityville, State',
            'type_of_company' => 'Tech Startup',
            'notes' => 'Sophia is interested in our software development services for her startup.',
        ]);

        ClientAccount::create([
            'name' => 'Daniel Rodriguez',
            'phone' => '5552345678',
            'residential_address' => '567 Maple Avenue, Suburbia, State',
            'company_name' => 'Rodriguez Consulting',
            'company_address' => '890 Business Road, Megatown, State',
            'type_of_company' => 'Consulting Firm',
            'notes' => 'Daniel has attended our workshops and is looking for ongoing collaboration.',
        ]);

        ClientAccount::create([
            'name' => 'Olivia Taylor',
            'phone' => '5558765432',
            'residential_address' => '456 Elm Street, Countryside, State',
            'company_name' => 'Taylor Enterprises',
            'company_address' => '123 Commerce Lane, Villagetown, State',
            'type_of_company' => 'Retail Business',
            'notes' => 'Olivia is a retail owner interested in our marketing and branding services.',
        ]);

        ClientAccount::create([
            'name' => 'Liam Wilson',
            'phone' => '5551112233',
            'residential_address' => '789 Oak Street, Suburbia, State',
            'company_name' => 'Wilson Tech Solutions',
            'company_address' => '456 Innovation Road, Citytown, State',
            'type_of_company' => 'Technology Services',
            'notes' => 'Liam is looking for IT solutions to enhance the efficiency of his business operations.',
        ]);

        ClientAccount::create([
            'name' => 'Ava White',
            'phone' => '5553322111',
            'residential_address' => '567 Pine Lane, Countryside, State',
            'company_name' => 'White Design Studio',
            'company_address' => '890 Creativity Avenue, Artcity, State',
            'type_of_company' => 'Creative Agency',
            'notes' => 'Ava is interested in our graphic design and branding services for her design studio.',
        ]);

        ClientAccount::create([
            'name' => 'Noah Lewis',
            'phone' => '5554445566',
            'residential_address' => '123 Maple Avenue, Townsville, State',
            'company_name' => 'Lewis Construction',
            'company_address' => '234 Builder Street, Constructionville, State',
            'type_of_company' => 'Construction Company',
            'notes' => 'Noah is seeking construction project management services for his company.',
        ]);

        ClientAccount::create([
            'name' => 'Isabella Turner',
            'phone' => '5556677889',
            'residential_address' => '456 Birch Street, Megatown, State',
            'company_name' => 'Turner Marketing Group',
            'company_address' => '789 Promotions Lane, Cityville, State',
            'type_of_company' => 'Marketing Agency',
            'notes' => 'Isabella is interested in our digital marketing services to boost her company\'s online presence.',
        ]);
    }
}
