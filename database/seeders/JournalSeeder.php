<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use App\Models\Journal;
use App\Models\Conference;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JournalSeeder extends Seeder
{
    public function run(): void
    {
        // Journals
        $j1 = Journal::create([
            'name_uz' => 'Kriminologiya va huquqbuzarlikning oldini olish',
            'name_en' => 'Criminology and Crime Prevention',
            'name_ru' => 'Криминология и предупреждение преступности',
            'slug' => 'kriminologiya-va-huquqbuzarlik',
            'issn_print' => '2181-1234',
            'issn_online' => '2181-5678',
            'description_uz' => 'O\'zbekiston Respublikasi kriminologiya sohasidagi etakchi ilmiy jurnal.',
            'description_en' => 'Leading scientific journal in criminology in the Republic of Uzbekistan.',
            'cover_image' => null,
            'aims_and_scope' => 'Jurnal kriminologiya, jinoyat huquqi va huquqbuzarlikning oldini olish masalalarini qamrab oladi.',
            'peer_review_policy' => 'Barcha maqolalar ikki tomonlama ko\'r ko\'zdan kechirish (double-blind peer review) jarayonidan o\'tadi.',
            'author_guidelines' => 'Maqolalar Word yoki PDF formatida qabul qilinadi. Hajm 15-25 sahifa.',
            'ethics_policy' => 'Plagiat qat\'iyan man etiladi. Mualliflar o\'z ishlarining asl ekanligini tasdiqlaydi.',
            'chief_editor' => 'Prof. Abdullayev Anvar Baxtiyor o\'g\'li',
            'chief_editor_title' => 'Yuridik fanlar doktori, professor',
            'frequency' => 'quarterly',
            'founding_year' => 2015,
            'submission_email' => 'submit@criminology-journal.uz',
            'is_indexed_google_scholar' => true,
            'is_indexed_hak' => true,
            'is_indexed_inlibrary' => false,
            'status' => 'active',
        ]);

        $j2 = Journal::create([
            'name_uz' => 'Huquq va jamiyat',
            'name_en' => 'Law and Society',
            'name_ru' => 'Право и общество',
            'slug' => 'huquq-va-jamiyat',
            'issn_print' => '2181-4321',
            'issn_online' => '2181-8765',
            'description_uz' => 'Huquq va jamiyat munosabatlarini tadqiq etuvchi ilmiy jurnal.',
            'description_en' => 'Scientific journal researching the relationship between law and society.',
            'frequency' => 'biannual',
            'founding_year' => 2018,
            'chief_editor' => 'Prof. Karimova Nilufar Rashidovna',
            'chief_editor_title' => 'Yuridik fanlar doktori',
            'is_indexed_google_scholar' => true,
            'is_indexed_hak' => false,
            'status' => 'active',
        ]);

        // Authors
        $a1 = Author::create([
            'first_name' => 'Javlon',
            'last_name' => 'Rahimov',
            'email' => 'j.rahimov@tdiyu.uz',
            'orcid' => '0000-0001-2345-6789',
            'organization' => 'Toshkent davlat yuridik universiteti',
            'country' => 'O\'zbekiston',
        ]);

        $a2 = Author::create([
            'first_name' => 'Dilnoza',
            'last_name' => 'Yusupova',
            'email' => 'd.yusupova@academy.uz',
            'orcid' => '0000-0002-3456-7890',
            'organization' => 'O\'zbekiston Respublikasi IIV Akademiyasi',
            'country' => 'O\'zbekiston',
        ]);

        $a3 = Author::create([
            'first_name' => 'Bobur',
            'last_name' => 'Toshmatov',
            'email' => 'b.toshmatov@tdiyu.uz',
            'organization' => 'Toshkent davlat yuridik universiteti',
            'country' => 'O\'zbekiston',
        ]);

        $a4 = Author::create([
            'first_name' => 'Shaxlo',
            'last_name' => 'Mirzayeva',
            'email' => 'sh.mirzayeva@sam.uz',
            'organization' => 'Samarqand davlat universiteti',
            'country' => 'O\'zbekiston',
        ]);

        // Articles
        $articles = [
            [
                'journal_id' => $j1->id,
                'title_uz' => 'O\'zbekistonda kiberjinoyatchilik: hozirgi holat va istiqbollari',
                'title_en' => 'Cybercrime in Uzbekistan: Current State and Prospects',
                'slug' => 'ozbekistonda-kiberjinoyatchilik',
                'abstract_uz' => 'Ushbu maqolada O\'zbekistondagi kiberjinoyatchilik holatining zamonaviy tendensiyalari, ularning oldini olish mexanizmlari va xalqaro tajriba tahlil qilinadi. Tadqiqot natijalarida kiberjinoyatlarning o\'sish dinamikasi va ularning huquqiy tartibga solinishi masalalari yoritilgan.',
                'abstract_en' => 'This article analyzes the current trends in cybercrime in Uzbekistan, prevention mechanisms, and international experience.',
                'keywords_uz' => 'kiberjinoyat, axborot xavfsizligi, raqamli jinoyatchilik, huquqiy tartibga solish',
                'keywords_en' => 'cybercrime, information security, digital crime, legal regulation',
                'volume' => 10,
                'issue' => 1,
                'page_from' => 1,
                'page_to' => 15,
                'doi' => '10.12345/krim.2025.01.001',
                'language' => 'uz',
                'article_type' => 'research',
                'status' => 'published',
                'published_at' => '2025-01-15',
                'received_at' => '2024-11-01',
                'accepted_at' => '2024-12-20',
                'view_count' => 234,
                'download_count' => 89,
                'references' => '<p>1. Karimov A.B. Kiberjinoyatchilik va axborot xavfsizligi. Toshkent: Fan, 2023.</p><p>2. Smith J. Cybercrime and Digital Investigations. Oxford University Press, 2022.</p><p>3. Wall D. Cybercrime: The Transformation of Crime in the Information Age. Cambridge, 2021.</p>',
                'authors' => [$a1->id => ['order' => 1, 'is_corresponding' => true], $a2->id => ['order' => 2, 'is_corresponding' => false]],
            ],
            [
                'journal_id' => $j1->id,
                'title_uz' => 'Voyaga yetmaganlar jinoyatchiligi profilaktikasi: zamonaviy yondashuvlar',
                'title_en' => 'Prevention of Juvenile Delinquency: Modern Approaches',
                'slug' => 'voyaga-yetmaganlar-jinoyatchiligi',
                'abstract_uz' => 'Maqolada voyaga yetmaganlar jinoyatchiligining oldini olishning zamonaviy usullari va xorijiy mamlakatlar tajribasi o\'rganiladi.',
                'abstract_en' => 'The article examines modern methods of preventing juvenile delinquency and the experience of foreign countries.',
                'keywords_uz' => 'voyaga yetmaganlar, jinoyat profilaktikasi, balog\'at, ijtimoiy muhit',
                'volume' => 10,
                'issue' => 1,
                'page_from' => 16,
                'page_to' => 30,
                'doi' => '10.12345/krim.2025.01.002',
                'language' => 'uz',
                'article_type' => 'research',
                'status' => 'published',
                'published_at' => '2025-01-15',
                'view_count' => 178,
                'download_count' => 56,
                'references' => '<p>1. Rashidov K.M. Voyaga yetmaganlar jinoyatchiligi. Toshkent, 2022.</p><p>2. Farrington D.P. Early prevention of adult antisocial behaviour. Cambridge, 2020.</p>',
                'authors' => [$a2->id => ['order' => 1, 'is_corresponding' => true]],
            ],
            [
                'journal_id' => $j1->id,
                'title_uz' => 'Korrupsiyaga qarshi kurashning huquqiy mexanizmlari',
                'title_en' => 'Legal Mechanisms of Anti-Corruption',
                'slug' => 'korrupsiyaga-qarshi-kurash',
                'abstract_uz' => 'Ushbu tadqiqotda O\'zbekistonda korrupsiyaga qarshi kurashning huquqiy asoslari, mavjud muammolar va yechimlar tahlili keltiriladi.',
                'keywords_uz' => 'korrupsiya, pora, huquqiy mexanizm, shaffoflik',
                'keywords_en' => 'corruption, bribery, legal mechanism, transparency',
                'volume' => 10,
                'issue' => 2,
                'page_from' => 1,
                'page_to' => 22,
                'doi' => '10.12345/krim.2025.02.001',
                'language' => 'uz',
                'article_type' => 'research',
                'status' => 'published',
                'published_at' => '2025-04-15',
                'view_count' => 312,
                'download_count' => 145,
                'references' => '<p>1. Transparency International. Corruption Perceptions Index 2024.</p><p>2. O\'zbekiston Respublikasi "Korrupsiyaga qarshi kurashish to\'g\'risida"gi Qonuni, 2017.</p>',
                'authors' => [$a3->id => ['order' => 1, 'is_corresponding' => true], $a1->id => ['order' => 2, 'is_corresponding' => false]],
            ],
            [
                'journal_id' => $j2->id,
                'title_uz' => 'Fuqarolik jamiyati va huquqiy davlat munosabatlari',
                'title_en' => 'Relations between Civil Society and the Rule of Law',
                'slug' => 'fuqarolik-jamiyati-huquqiy-davlat',
                'abstract_uz' => 'Maqolada fuqarolik jamiyati institutlarining huquqiy davlat qurishda tutgan o\'rni va ahamiyati tadqiq etiladi.',
                'keywords_uz' => 'fuqarolik jamiyat, huquqiy davlat, demokratiya, inson huquqlari',
                'volume' => 7,
                'issue' => 1,
                'page_from' => 1,
                'page_to' => 18,
                'doi' => '10.12345/hj.2025.01.001',
                'language' => 'uz',
                'article_type' => 'review',
                'status' => 'published',
                'published_at' => '2025-03-01',
                'view_count' => 145,
                'download_count' => 67,
                'references' => '<p>1. Habermas J. Between Facts and Norms. MIT Press, 1996.</p><p>2. Karimov I. Buyuk kelajak sari. Toshkent: O\'zbekiston, 2020.</p>',
                'authors' => [$a4->id => ['order' => 1, 'is_corresponding' => true], $a3->id => ['order' => 2, 'is_corresponding' => false]],
            ],
            [
                'journal_id' => $j2->id,
                'title_uz' => 'Raqamli huquq: zamonaviy muammolar va yechimlar',
                'title_en' => 'Digital Law: Modern Problems and Solutions',
                'slug' => 'raqamli-huquq-muammolar',
                'abstract_uz' => 'Sun\'iy intellekt, blokcheyn va raqamli texnologiyalarning huquqiy tartibga solinishi masalalari tahlil qilinadi.',
                'abstract_en' => 'Analysis of legal regulation of artificial intelligence, blockchain and digital technologies.',
                'keywords_uz' => 'raqamli huquq, sun\'iy intellekt, blokcheyn, ma\'lumotlar himoyasi',
                'keywords_en' => 'digital law, artificial intelligence, blockchain, data protection',
                'volume' => 7,
                'issue' => 1,
                'page_from' => 19,
                'page_to' => 35,
                'doi' => '10.12345/hj.2025.01.002',
                'language' => 'multi',
                'article_type' => 'research',
                'status' => 'published',
                'published_at' => '2025-03-01',
                'view_count' => 98,
                'download_count' => 42,
                'references' => '<p>1. Schwab K. The Fourth Industrial Revolution. Crown Business, 2017.</p>',
                'authors' => [$a1->id => ['order' => 1, 'is_corresponding' => true], $a4->id => ['order' => 2, 'is_corresponding' => false]],
            ],
        ];

        foreach ($articles as $data) {
            $authorData = $data['authors'];
            unset($data['authors']);
            $article = Article::create($data);
            foreach ($authorData as $authorId => $pivotData) {
                $article->authors()->attach($authorId, $pivotData);
            }
        }

        // Conference
        Conference::create([
            'title_uz' => 'Xalqaro kriminologiya konferensiyasi — 2025',
            'title_en' => 'International Criminology Conference — 2025',
            'slug' => 'xalqaro-kriminologiya-2025',
            'description_uz' => 'O\'zbekistonda birinchi marta o\'tkazilayotgan xalqaro kriminologiya konferensiyasi.',
            'description_en' => 'The first international criminology conference held in Uzbekistan.',
            'venue' => 'Toshkent, Hilton Hotel',
            'start_date' => '2025-09-15',
            'end_date' => '2025-09-17',
            'submission_deadline' => '2025-07-01',
            'registration_deadline' => '2025-08-15',
            'status' => 'upcoming',
            'topics' => 'Kiberjinoyatchilik, Voyaga yetmaganlar jinoyatchiligi, Terrorizmga qarshi kurash, Korrupsiyaga qarshi kurash',
        ]);

        Conference::create([
            'title_uz' => 'Huquq va texnologiyalar forumi',
            'title_en' => 'Law and Technology Forum',
            'slug' => 'huquq-texnologiya-forum-2025',
            'description_uz' => 'Raqamli davr huquqiy muammolari bo\'yicha forum.',
            'venue' => 'Online',
            'start_date' => '2025-11-10',
            'end_date' => '2025-11-11',
            'submission_deadline' => '2025-09-30',
            'is_online' => true,
            'status' => 'upcoming',
        ]);

        // News
        News::create([
            'title_uz' => 'Jurnal Google Scholar indeksiga kiritildi',
            'title_en' => 'Journal Indexed in Google Scholar',
            'slug' => 'google-scholar-indekslash',
            'excerpt' => 'Kriminologiya va huquqbuzarlikning oldini olish jurnali Google Scholar bazasiga kiritildi.',
            'body_uz' => '<p>Hurmatli hamkasblar! Biz katta mamnuniyat bilan e\'lon qilamizki, bizning "Kriminologiya va huquqbuzarlikning oldini olish" jurnali Google Scholar indeksatsiya bazasiga muvaffaqiyatli kiritildi.</p><p>Bu yutuq jurnalimiz ilmiy sifatining xalqaro darajada tan olinganini anglatadi.</p>',
            'is_featured' => true,
            'status' => 'published',
            'published_at' => now()->subDays(5),
        ]);

        News::create([
            'title_uz' => 'Maqola qabul qilish muddati uzaytirildi',
            'title_en' => 'Article Submission Deadline Extended',
            'slug' => 'maqola-qabul-muddati',
            'excerpt' => '2025-yil 2-son uchun maqola qabul qilish muddati 2025-yil 15-iyungacha uzaytirildi.',
            'body_uz' => '<p>Hurmatli mualliflar! 2025-yil 2-son uchun maqolalar qabul qilish muddati 2025-yil 15-iyungacha uzaytirildi. Maqolalaringizni submit@criminology-journal.uz manziliga yuboring.</p>',
            'status' => 'published',
            'published_at' => now()->subDays(2),
        ]);

        News::create([
            'title_uz' => 'Yangi bosh muharrir tayinlandi',
            'title_en' => 'New Editor-in-Chief Appointed',
            'slug' => 'yangi-bosh-muharrir',
            'excerpt' => 'Prof. Abdullayev Anvar Baxtiyor o\'g\'li jurnal bosh muharriri etib tayinlandi.',
            'body_uz' => '<p>2025-yil 1-yanvardan boshlab Prof. Abdullayev Anvar Baxtiyor o\'g\'li "Kriminologiya va huquqbuzarlikning oldini olish" jurnalining yangi bosh muharriri etib tayinlandi.</p>',
            'status' => 'published',
            'published_at' => now()->subDays(30),
        ]);
    }
}
