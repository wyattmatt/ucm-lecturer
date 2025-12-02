<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecturers = [
            ['name' => 'Dr. Ir. Tony Antonio, M. Eng.', 'title' => 'Dosen, Ketua', 'room' => '202', 'departments' => ['Magister Management'], 'image' => 'tony_antonio.png'],
            ['name' => 'Dr. E. Elia Ardyan, S.E., MBA.', 'title' => 'Dosen, Ketua Prodi Manajemen', 'room' => '203', 'departments' => ['Management', 'Magister Management'], 'image' => 'e_elia_ardyan.png'],
            ['name' => 'Dr. Adityawarman M. Kouwagam, S.H., M.Kn.', 'title' => 'Dosen', 'room' => '410', 'departments' => ['Management'], 'image' => 'adityawarman_m_kouwagam.png'],
            ['name' => 'Asriah Syam, S.E., M.M.', 'title' => 'Dosen', 'room' => '411', 'departments' => ['Management'], 'image' => 'asriah_syam.png'],
            ['name' => 'Dr. Carolina Novi Mustikarini, S.E., M.Sc., LP-NLP.', 'title' => 'Dosen', 'room' => '201', 'departments' => ['Management', 'Magister Management'], 'image' => 'carolina_novi_mustikarini.png'],
            ['name' => 'Cindy Yoel Tanesia S.E., MBA.', 'title' => 'Dosen', 'room' => '508', 'departments' => ['Management'], 'image' => 'cindy_yoel_tanesia.png'],
            ['name' => 'Cipta Canggih Perdana, S.E., M.M.', 'title' => 'Dosen', 'room' => '604', 'departments' => ['Management'], 'image' => 'cipta_canggih_perdana.png'],
            ['name' => 'Dr. Erwin Parega, S.E., M.M.', 'title' => 'Dosen', 'room' => '605', 'departments' => ['Management', 'Magister Management'], 'image' => 'erwin_parega.png'],
            ['name' => 'Fia Fauzia Burhanuddin, B.Bus., M.Ak.', 'title' => 'Dosen', 'room' => '201', 'departments' => ['Management'], 'image' => 'fia_fauzia_burhanuddin.png'],
            ['name' => 'Gracela Marisa Sanapang, S.P., M.M.', 'title' => 'Dosen', 'room' => '411', 'departments' => ['Management'], 'image' => 'gracela_marisa_sanapang.png'],
            ['name' => 'Justin Wijaya, S.E., M.M.', 'title' => 'Dosen', 'room' => '102', 'departments' => ['Management'], 'image' => 'justin_wijaya.png'],
            ['name' => 'Maichal, S.E., M.Sc.', 'title' => 'Dosen', 'room' => '106', 'departments' => ['Management'], 'image' => 'maichal.png'],
            ['name' => 'Michael Ricky Sondak, S.E., M.M.', 'title' => 'Dosen', 'room' => '410', 'departments' => ['Management'], 'image' => 'michael_ricky_sondak.png'],
            ['name' => 'Dr. Monalisa, S.E., M.M.', 'title' => 'Dosen', 'room' => '201', 'departments' => ['Management', 'Magister Management'], 'image' => 'monalisa.png'],
            ['name' => 'Dr. Muchtar, S.E., M.Si.', 'title' => 'Dosen', 'room' => '401', 'departments' => ['Management', 'Magister Management'], 'image' => 'muchtar.png'],
            ['name' => 'Muh. Syulhasbiullah, S.M., M.I.Kom., M.M.', 'title' => 'Dosen', 'room' => '408', 'departments' => ['Management'], 'image' => 'muh_syulhasbiullah.png'],
            ['name' => 'Dr. Mustika Kusuma Basir S.Psi., M.M., CPS., CHCM.,CODP.', 'title' => 'Dosen', 'room' => '407', 'departments' => ['Management', 'Magister Management'], 'image' => 'mustika_kusuma_basir.png'],
            ['name' => 'Dr. Natali Ikawidjaja, M.M., CRP.', 'title' => 'Dosen', 'room' => '405', 'departments' => ['Management', 'Magister Management'], 'image' => 'natali_ikawidjaja.png'],
            ['name' => 'Novalina Gloria Simanungkalit, S.Psi., M.Psi., Psikolog, CLMA®', 'title' => 'Dosen', 'room' => '204', 'departments' => ['Management'], 'image' => 'novalina_gloria_simanungkalit.png'],
            ['name' => 'Novieanty Pagiling, S.E., M.Sc.', 'title' => 'Dosen', 'room' => '407', 'departments' => ['Management'], 'image' => 'novieanty_pagiling.png'],
            ['name' => 'Novika Ayu Triany, S.I.Kom., M.I.Kom.', 'title' => 'Dosen', 'room' => '303', 'departments' => ['Management'], 'image' => 'novika_ayu_triany.png'],
            ['name' => 'Powell Gian Hartono, S.M., M.M., RSA®', 'title' => 'Dosen', 'room' => '307', 'departments' => ['Management'], 'image' => 'powell_gian_hartono.png'],
            ['name' => 'Dr. Salmah Sharon, S.E., M.Si., Ak., CA., CSRS., CSRA.', 'title' => 'Dosen', 'room' => '310', 'departments' => ['Management', 'Magister Management'], 'image' => 'salmah_sharon.png'],
            ['name' => 'Sinar Dharmayana Putra, S.E., M.M.', 'title' => 'Dosen', 'room' => '308', 'departments' => ['Management'], 'image' => 'sinar_dharmayana_putra.png'],
            ['name' => 'Winarto Poernomo, S.E., M.M.', 'title' => 'Dosen', 'room' => '304', 'departments' => ['Management'], 'image' => 'winarto_poernomo.png'],
            ['name' => 'Yuyun Karystin Meilisa Suade, S.M., M.M.', 'title' => 'Dosen', 'room' => '406', 'departments' => ['Management'], 'image' => 'yuyun_karystin_meilisa_suade.png'],
            ['name' => 'Giovanni Marras', 'title' => 'Dosen', 'room' => '102', 'departments' => ['Management'], 'image' => 'giovanni_marras.png'],
            ['name' => 'David Sundoro, S.T., M.MT.', 'title' => 'Ketua Prodi Informatika', 'room' => '501', 'departments' => ['Informatics'], 'image' => 'david_sundoro.png'],
            ['name' => 'Ir. Kasmir Syariati, S.Kom., M.T.', 'title' => 'Dosen', 'room' => '502', 'departments' => ['Informatics'], 'image' => 'kasmir_syariati.png'],
            ['name' => 'Citra Suardi, S.Kom., M.T.', 'title' => 'Dosen', 'room' => '508', 'departments' => ['Informatics'], 'image' => 'citra_suardi.png'],
            ['name' => 'Arnold Nasir, B.Sc.(Hons.), M.Sc.', 'title' => 'Dosen', 'room' => '504', 'departments' => ['Informatics'], 'image' => 'arnold_nasir.png'],
            ['name' => 'Reinaldo Lewis Lordianto, S.Kom', 'title' => 'Laboran', 'room' => '503', 'departments' => ['Informatics'], 'image' => 'reinaldo_lewis_lordianto.png'],
            ['name' => 'Ir. Juan Salao Biantong, S.Kom., M.T', 'title' => 'Dosen', 'room' => '302', 'departments' => ['Informatics'], 'image' => 'juan_salao_biantong.png'],
            ['name' => 'Niken Savitri Anggraeni, S.Sn., M.Ds.', 'title' => 'Ketua Prodi Desain Komunikasi Visual', 'room' => '602', 'departments' => ['Visual Communication Design'], 'image' => 'niken_savitri_anggraeni.png'],
            ['name' => 'Ahmad Ade Nugraha, S.Ds., M.Ds.', 'title' => 'Dosen', 'room' => '605', 'departments' => ['Visual Communication Design'], 'image' => 'ahmad_ade_nugraha.png'],
            ['name' => 'Andra Rizky Yuwono, S.Ds., M.Ds.', 'title' => 'Dosen', 'room' => '603', 'departments' => ['Visual Communication Design'], 'image' => 'andra_rizky_yuwono.png'],
            ['name' => 'Bilyan Putra Sari, S.Ds., M.Ds.', 'title' => 'Dosen', 'room' => '604', 'departments' => ['Visual Communication Design'], 'image' => 'bilyan_putra_sari.png'],
            ['name' => 'Rahmat Zulfikar, S.Ds., M.Ds.', 'title' => 'Dosen', 'room' => '601', 'departments' => ['Visual Communication Design'], 'image' => 'rahmat_zulfikar.png'],
            ['name' => 'Afrizal Firman, S.IP., MBA., Ph.D.', 'title' => 'Ketua Prodi Magister Manajemen', 'room' => '470', 'departments' => ['Magister Management'], 'image' => 'afrizal_firman.png'],
        ];

        foreach ($lecturers as $lecturer) {
            Lecturer::create($lecturer);
        }
    }
}
