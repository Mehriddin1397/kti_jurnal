<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use App\Models\Journal;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'tahrir-hayati',
                'title_uz' => 'Tahrir hay\'ati',
                'title_en' => 'Editorial Board',
                'title_ru' => 'Редакционная коллегия',
                'description_uz' => 'Jurnal bosh muharriri va tahrir hay\'ati a\'zolari haqida ma\'lumot.',
                'description_en' => 'Information about the editor-in-chief and members of the editorial board.',
                'description_ru' => 'Информация о главном редакторе и членах редакционной коллегии.',
            ],
            [
                'slug' => 'mualliflar-qollanma',
                'title_uz' => 'Mualliflar uchun qo\'llanma',
                'title_en' => 'Author Guidelines',
                'title_ru' => 'Руководство для авторов',
                'description_uz' => 'Maqola tayyorlash, yuborish va nashr qilish bo\'yicha talablar va ko\'rsatmalar.',
                'description_en' => 'Requirements and instructions for preparing, submitting, and publishing articles.',
                'description_ru' => 'Требования и инструкции по подготовке, подаче и публикации статей.',
            ],
            [
                'slug' => 'aloqa',
                'title_uz' => 'Aloqa',
                'title_en' => 'Contact',
                'title_ru' => 'Контакты',
                'description_uz' => 'Jurnal tahririyati va nashriyot bilan bog\'lanish ma\'lumotlari.',
                'description_en' => 'Contact details for the journal editorial office and publisher.',
                'description_ru' => 'Контактная информация редакции и издателя журнала.',
            ],
            [
                'slug' => 'indekslash',
                'title_uz' => 'Indekslash',
                'title_en' => 'Indexing',
                'title_ru' => 'Индексирование',
                'description_uz' => 'Jurnal qaysi ilmiy bazalar va indekslarda ro\'yxatdan o\'tganligi.',
                'description_en' => 'Scientific databases and indexes in which the journal is listed.',
                'description_ru' => 'Научные базы данных и индексы, в которых зарегистрирован журнал.',
            ],
            [
                'slug' => 'manfaatlar-ai-siyosati',
                'title_uz' => 'Manfaatlar to\'qnashuvi va AI siyosati',
                'title_en' => 'Conflicts of Interest and AI Policy',
                'title_ru' => 'Конфликт интересов и политика ИИ',
                'description_uz' => 'Manfaatlar to\'qnashuvi va sun\'iy intellektdan foydalanish qoidalari.',
                'description_en' => 'Rules on conflicts of interest and the use of artificial intelligence.',
                'description_ru' => 'Правила конфликта интересов и использования искусственного интеллекта.',
            ],
            [
                'slug' => 'shikoyatlar-apellyatsiyalar',
                'title_uz' => 'Shikoyatlar va apellyatsiyalar',
                'title_en' => 'Complaints and Appeals',
                'title_ru' => 'Жалобы и апелляции',
                'description_uz' => 'Nashr jarayoniga oid shikoyatlar va apellyatsiyalarni ko\'rib chiqish tartibi.',
                'description_en' => 'Procedure for reviewing complaints and appeals related to the publication process.',
                'description_ru' => 'Порядок рассмотрения жалоб и апелляций, связанных с процессом публикации.',
            ],
            [
                'slug' => 'tuzatish-qaytarib-olish',
                'title_uz' => 'Tuzatish va qaytarib olish',
                'title_en' => 'Corrections and Retractions',
                'title_ru' => 'Исправления и отзывы публикаций',
                'description_uz' => 'Chop etilgan materiallarni tuzatish, yangilash yoki qaytarib olish siyosati.',
                'description_en' => 'Policy on correcting, updating, or retracting published materials.',
                'description_ru' => 'Политика исправления, обновления или отзыва опубликованных материалов.',
            ],
            [
                'slug' => 'arxivlash-repozitoriy',
                'title_uz' => 'Arxivlash va repozitoriy siyosati',
                'title_en' => 'Archiving and Repository Policy',
                'title_ru' => 'Политика архивирования и репозиториев',
                'description_uz' => 'Nashr etilgan materiallarni saqlash, arxivlash va repozitoriyga joylash tartibi.',
                'description_en' => 'Rules for preserving, archiving, and depositing published materials in repositories.',
                'description_ru' => 'Правила хранения, архивирования и размещения опубликованных материалов в репозиториях.',
            ],
            [
                'slug' => 'muallif-tolovi',
                'title_uz' => 'Muallif to\'lovi',
                'title_en' => 'Article Processing Charges',
                'title_ru' => 'Оплата со стороны авторов',
                'description_uz' => 'Maqola nashr etish bilan bog\'liq to\'lovlar va imtiyozlar haqida.',
                'description_en' => 'Information on publication fees, waivers, and related charges.',
                'description_ru' => 'Информация о плате за публикацию, льготах и связанных сборах.',
            ],
            [
                'slug' => 'mualliflik-huquqi',
                'title_uz' => 'Mualliflik huquqi va litsenziyalash',
                'title_en' => 'Copyright and Licensing',
                'title_ru' => 'Авторское право и лицензирование',
                'description_uz' => 'Mualliflik huquqi, litsenziya turlari va foydalanish shartlari.',
                'description_en' => 'Copyright ownership, license types, and terms of use.',
                'description_ru' => 'Авторские права, типы лицензий и условия использования.',
            ],
            [
                'slug' => 'plagiat-siyosati',
                'title_uz' => 'Plagiat siyosati',
                'title_en' => 'Plagiarism Policy',
                'title_ru' => 'Политика в отношении плагиата',
                'description_uz' => 'Plagiat va o\'zga manbalardan noqonuniy foydalanishga qarshi choralar.',
                'description_en' => 'Measures against plagiarism and unauthorized use of sources.',
                'description_ru' => 'Меры против плагиата и несанкционированного использования источников.',
            ],
            [
                'slug' => 'nashr-etikasi',
                'title_uz' => 'Nashr etikasi',
                'title_en' => 'Publication Ethics',
                'title_ru' => 'Этика публикаций',
                'description_uz' => 'Ilmiy nashr etikasi, halollik va mas\'uliyat tamoyillari.',
                'description_en' => 'Principles of scientific publication ethics, integrity, and responsibility.',
                'description_ru' => 'Принципы этики научных публикаций, добросовестности и ответственности.',
            ],
            [
                'slug' => 'ochiq-kirish',
                'title_uz' => 'Ochiq kirish',
                'title_en' => 'Open Access',
                'title_ru' => 'Открытый доступ',
                'description_uz' => 'Ochiq kirish siyosati va nashr etilgan materiallardan erkin foydalanish.',
                'description_en' => 'Open access policy and free use of published materials.',
                'description_ru' => 'Политика открытого доступа и свободное использование опубликованных материалов.',
            ],
            [
                'slug' => 'taqriz-jarayoni',
                'title_uz' => 'Taqriz jarayoni',
                'title_en' => 'Peer Review Process',
                'title_ru' => 'Рецензирование',
                'description_uz' => 'Maqolalarni taqrizdan o\'tkazish tartibi va mezonlari.',
                'description_en' => 'Procedure and criteria for peer review of submitted manuscripts.',
                'description_ru' => 'Порядок и критерии рецензирования представленных рукописей.',
            ],
            [
                'slug' => 'maqsad-yonalishlar',
                'title_uz' => 'Maqsad va yo\'nalishlar',
                'title_en' => 'Aims and Scope',
                'title_ru' => 'Цели и направления',
                'description_uz' => 'Jurnalning ilmiy maqsadlari, qamrovi va asosiy tadqiqot yo\'nalishlari.',
                'description_en' => 'Scientific aims, scope, and main research areas of the journal.',
                'description_ru' => 'Научные цели, охват и основные направления исследований журнала.',
            ],
            [
                'slug' => 'jurnal-haqida',
                'title_uz' => 'Jurnal haqida',
                'title_en' => 'About the Journal',
                'title_ru' => 'О журнале',
                'description_uz' => 'Jurnal tarixi, missiyasi va umumiy ma\'lumotlar.',
                'description_en' => 'History, mission, and general information about the journal.',
                'description_ru' => 'История, миссия и общая информация о журнале.',
            ],
            [
                'slug' => 'tadqiqotlar',
                'title_uz' => 'Tadqiqotlar',
                'title_en' => 'Research',
                'title_ru' => 'Исследования',
                'description_uz' => 'Jurnalda chop etiladigan tadqiqot turlari va ilmiy yo\'nalishlar.',
                'description_en' => 'Types of research and scientific areas published in the journal.',
                'description_ru' => 'Типы исследований и научные направления, публикуемые в журнале.',
            ],
            [
                'slug' => 'maxfiylik-bayonoti',
                'title_uz' => 'Maxfiylik bayonoti',
                'title_en' => 'Privacy Policy',
                'title_ru' => 'Политика конфиденциальности',
                'description_uz' => 'Foydalanuvchi ma\'lumotlarini yig\'ish, saqlash va himoya qilish qoidalari.',
                'description_en' => 'Rules for collecting, storing, and protecting user information.',
                'description_ru' => 'Правила сбора, хранения и защиты пользовательской информации.',
            ],
        ];

        foreach (Journal::all() as $journal) {
            foreach ($pages as $index => $page) {
                AboutPage::updateOrCreate(
                    ['journal_id' => $journal->id, 'slug' => $page['slug']],
                    array_merge($page, [
                        'journal_id' => $journal->id,
                        'sort_order' => $index + 1,
                        'is_active' => true,
                    ])
                );
            }
        }
    }
}
