// Data for Majors
const majorsData = [
    {
        id: 1,
        name: 'Teknologi Informasi (TI)',
        category: 'Kejuruan',
        shortDesc: 'Program keahlian di bidang teknologi dan sistem informasi',
        description: 'Jurusan Teknologi Informasi menyiapkan siswa untuk menjadi profesional yang menguasai pengembangan perangkat lunak, infrastruktur jaringan, dan manajemen basis data.',
        subjects: [
            'Pemrograman Web',
            'Pemrograman Mobile',
            'Basis Data',
            'Jaringan Komputer',
            'Sistem Operasi',
            'Keamanan Siber',
            'Cloud Computing',
            'Algoritma dan Struktur Data'
        ],
        practices: [
            'Praktik Pemrograman dengan berbagai bahasa pemrograman (Python, Java, JavaScript)',
            'Membangun dan mengelola jaringan komputer',
            'Mengembangkan aplikasi web dan mobile',
            'Mengadministrasi server dan database',
            'Melakukan penetration testing dan security audit',
            'Bekerja dalam tim menggunakan metodologi agile'
        ],
        careers: [
            'Software Developer',
            'Web Developer',
            'Mobile App Developer',
            'Database Administrator',
            'Network Administrator',
            'Security Analyst',
            'Cloud Architect',
            'IT Project Manager'
        ]
    },
    {
        id: 2,
        name: 'Desain Grafis (DG)',
        category: 'Kejuruan',
        shortDesc: 'Program keahlian di bidang desain visual dan komunikasi grafis',
        description: 'Jurusan Desain Grafis mempersiapkan siswa untuk menghasilkan karya desain visual berkualitas tinggi untuk berbagai media dan platform komunikasi.',
        subjects: [
            'Desain Grafis Dasar',
            'Fotografi Digital',
            'Desain Web',
            'Desain Video',
            'Typography',
            'Color Theory',
            'UI/UX Design',
            'Motion Graphics'
        ],
        practices: [
            'Menggunakan software desain profesional (Adobe Creative Suite)',
            'Fotografi dan editing foto',
            'Desain kemasan produk dan label',
            'Membuat materi promosi dan iklan',
            'Desain interface aplikasi mobile dan web',
            'Pembuatan konten multimedia'
        ],
        careers: [
            'Graphic Designer',
            'UI/UX Designer',
            'Web Designer',
            'Photographer',
            'Motion Graphics Designer',
            'Brand Identity Designer',
            'Creative Director',
            'Advertising Designer'
        ]
    },
    {
        id: 3,
        name: 'Akuntansi (AK)',
        category: 'IPS',
        shortDesc: 'Program keahlian di bidang akuntansi dan keuangan',
        description: 'Jurusan Akuntansi menyiapkan siswa untuk mengelola keuangan perusahaan, membuat laporan keuangan, dan memastikan kepatuhan terhadap standar akuntansi.',
        subjects: [
            'Dasar-dasar Akuntansi',
            'Akuntansi Keuangan',
            'Akuntansi Manajemen',
            'Audit',
            'Perpajakan',
            'Sistem Informasi Akuntansi',
            'Akuntansi Biaya',
            'Analisis Laporan Keuangan'
        ],
        practices: [
            'Pencatatan transaksi keuangan',
            'Pembuatan laporan keuangan',
            'Audit internal perusahaan',
            'Perhitungan pajak',
            'Analisis neraca dan perubahan modal',
            'Penggunaan software akuntansi modern'
        ],
        careers: [
            'Akuntan',
            'Auditor',
            'Tax Consultant',
            'Financial Analyst',
            'Internal Auditor',
            'Accounting Manager',
            'Bookkeeper',
            'Financial Consultant'
        ]
    },
    {
        id: 4,
        name: 'Bisnis Manajemen (BM)',
        category: 'IPS',
        shortDesc: 'Program keahlian di bidang manajemen bisnis dan kewirausahaan',
        description: 'Jurusan Bisnis Manajemen mempersiapkan siswa untuk mengelola operasional bisnis, sumber daya manusia, dan strategi pemasaran.',
        subjects: [
            'Manajemen Umum',
            'Manajemen Pemasaran',
            'Manajemen Sumber Daya Manusia',
            'Kewirausahaan',
            'Ekonomi Bisnis',
            'Komunikasi Bisnis',
            'Etika Bisnis',
            'Strategi Bisnis'
        ],
        practices: [
            'Studi kasus manajemen perusahaan nyata',
            'Membuat business plan untuk startup',
            'Simulasi bisnis dan market research',
            'Pelatihan kepemimpinan dan kepemimpinan tim',
            'Negosiasi dan komunikasi bisnis',
            'Analisis kompetitor dan strategi pemasaran'
        ],
        careers: [
            'Business Manager',
            'Sales Manager',
            'Marketing Manager',
            'HR Manager',
            'Business Consultant',
            'Entrepreneur',
            'Operations Manager',
            'General Manager'
        ]
    },
    {
        id: 5,
        name: 'Administrasi Perkantoran (AP)',
        category: 'IPS',
        shortDesc: 'Program keahlian di bidang administrasi dan manajemen kantor',
        description: 'Jurusan Administrasi Perkantoran menyiapkan siswa untuk mengelola operasional kantor, dokumentasi, dan memberikan dukungan administratif.',
        subjects: [
            'Administrasi Umum',
            'Manajemen Perkantoran',
            'Kearsipan',
            'Komunikasi Bisnis',
            'Tata Usaha',
            'Pengetikan Cepat',
            'Kesekretarisan',
            'Teknologi Perkantoran'
        ],
        practices: [
            'Mengelola dokumen dan arsip kantor',
            'Menggunakan software perkantoran (MS Office)',
            'Protokol dan etiket bisnis',
            'Manajemen jadwal dan pertemuan',
            'Penanganan surat-menyurat bisnis',
            'Penyusunan laporan dan presentasi'
        ],
        careers: [
            'Office Administrator',
            'Secretary',
            'Administrative Assistant',
            'Receptionist',
            'Document Manager',
            'Office Manager',
            'Executive Secretary',
            'Administrative Coordinator'
        ]
    },
    {
        id: 6,
        name: 'Teknik Elektro (TE)',
        category: 'IPA',
        shortDesc: 'Program keahlian di bidang teknik elektro dan instalasi listrik',
        description: 'Jurusan Teknik Elektro mempersiapkan siswa untuk mendesain, membangun, dan memelihara sistem kelistrikan dan infrastruktur listrik.',
        subjects: [
            'Dasar Teknik Elektro',
            'Instalasi Listrik',
            'Mesin Listrik',
            'Elektronika',
            'Sistem Tenaga Listrik',
            'Teknik Kendali Otomatis',
            'Telekomunikasi',
            'Energi Terbarukan'
        ],
        practices: [
            'Instalasi sistem kelistrikan residensial dan komersial',
            'Perawatan mesin dan peralatan listrik',
            'Troubleshooting dan perbaikan sistem kelistrikan',
            'Pengujian dan kalibrasi peralatan',
            'Desain instalasi dengan CAD',
            'Keselamatan kerja di lingkungan berbahaya'
        ],
        careers: [
            'Electrical Engineer',
            'Electrician',
            'Power Plant Operator',
            'Maintenance Technician',
            'Electrical Supervisor',
            'Installation Engineer',
            'Quality Control Engineer',
            'Renewable Energy Specialist'
        ]
    },
    {
        id: 7,
        name: 'Teknik Mesin (TM)',
        category: 'IPA',
        shortDesc: 'Program keahlian di bidang perancangan dan manufaktur mesin',
        description: 'Jurusan Teknik Mesin menyiapkan siswa untuk mendesain, memproduksi, dan memelihara mesin serta peralatan mekanis.',
        subjects: [
            'Mekanika Teknik',
            'Desain Mesin',
            'Manufaktur',
            'Material Teknik',
            'Termodinamika',
            'Hidrolika dan Pneumatika',
            'CAD/CAM',
            'Teknik Pengelasan'
        ],
        practices: [
            'Desain komponen mesin dengan software CAD',
            'Pembuatan prototipe dan model',
            'Operasi mesin-mesin produksi',
            'Teknik pengelasan dan assembly',
            'Pengujian dan quality control',
            'Maintenance dan perbaikan mesin'
        ],
        careers: [
            'Mechanical Engineer',
            'Manufacturing Engineer',
            'Design Engineer',
            'Production Manager',
            'Maintenance Technician',
            'Plant Manager',
            'CAD Drafter',
            'Quality Engineer'
        ]
    },
    {
        id: 8,
        name: 'Farmasi (FM)',
        category: 'IPA',
        shortDesc: 'Program keahlian di bidang farmasi dan kesehatan',
        description: 'Jurusan Farmasi mempersiapkan siswa untuk bekerja di industri farmasi, apotek, dan layanan kesehatan.',
        subjects: [
            'Kimia Farmasi',
            'Farmakologi',
            'Farmasetika',
            'Teknologi Farmasi',
            'Analisis Farmasi',
            'Asuhan Farmasi',
            'Cosmetology',
            'Regulasi Farmasi'
        ],
        practices: [
            'Formulasi dan produksi obat',
            'Analisis kualitas farmasi',
            'Penguji keamanan dan efektivitas obat',
            'Layanan farmasi di apotek',
            'Edukasi pasien tentang obat',
            'Good Manufacturing Practice (GMP)'
        ],
        careers: [
            'Pharmacist',
            'Pharmaceutical Sales',
            'Quality Assurance Officer',
            'Regulatory Affairs Specialist',
            'Apoteker',
            'Clinical Pharmacist',
            'Pharmacy Manager',
            'Research & Development Scientist'
        ]
    }
];

// Forum Categories
const forumCategories = [
    { id: 1, name: 'Teknologi Informasi', color: '#667eea' },
    { id: 2, name: 'Desain Grafis', color: '#f093fb' },
    { id: 3, name: 'Akuntansi', color: '#4facfe' },
    { id: 4, name: 'Bisnis Manajemen', color: '#43e97b' },
    { id: 5, name: 'Administrasi Perkantoran', color: '#fa709a' },
    { id: 6, name: 'Teknik Elektro', color: '#30cfd0' },
    { id: 7, name: 'Teknik Mesin', color: '#a8edea' },
    { id: 8, name: 'Farmasi', color: '#fed6e3' },
    { id: 9, name: 'Umum', color: '#999999' }
];

// Forum Threads (stored in localStorage)
function getForumThreads() {
    const stored = localStorage.getItem('forumThreads');
    if (stored) {
        return JSON.parse(stored);
    }
    
    // Default threads
    const defaultThreads = [
        {
            id: 1,
            title: 'Apa perbedaan antara jurusan TI dan Desain Grafis?',
            category: 'Umum',
            author: 'Siswa Baru',
            content: 'Saya bingung memilih antara jurusan Teknologi Informasi atau Desain Grafis. Apa sih perbedaan kedua jurusan ini?',
            date: new Date(Date.now() - 2 * 24 * 60 * 60 * 1000).toLocaleDateString('id-ID'),
            replies: 3,
            views: 45
        },
        {
            id: 2,
            title: 'Prospek karir lulusan Akuntansi di Indonesia',
            category: 'Akuntansi',
            author: 'Orang Tua Siswa',
            content: 'Seberapa besar peluang kerja untuk lulusan jurusan Akuntansi?',
            date: new Date(Date.now() - 5 * 24 * 60 * 60 * 1000).toLocaleDateString('id-ID'),
            replies: 5,
            views: 78
        },
        {
            id: 3,
            title: 'Tips mempersiapkan ujian masuk jurusan Teknik Mesin',
            category: 'Teknik Mesin',
            author: 'Alumni TM 2023',
            content: 'Bagi yang ingin masuk jurusan Teknik Mesin, saya ingin berbagi tips apa yang saya pelajari...',
            date: new Date(Date.now() - 7 * 24 * 60 * 60 * 1000).toLocaleDateString('id-ID'),
            replies: 8,
            views: 120
        }
    ];
    
    localStorage.setItem('forumThreads', JSON.stringify(defaultThreads));
    return defaultThreads;
}

// Get forum replies
function getForumReplies(threadId) {
    const stored = localStorage.getItem(`threadReplies_${threadId}`);
    if (stored) {
        return JSON.parse(stored);
    }
    return [];
}

// Save forum thread
function saveForumThread(thread) {
    const threads = getForumThreads();
    thread.id = Math.max(...threads.map(t => t.id), 0) + 1;
    thread.date = new Date().toLocaleDateString('id-ID');
    thread.replies = 0;
    thread.views = 0;
    threads.unshift(thread);
    localStorage.setItem('forumThreads', JSON.stringify(threads));
    return thread;
}

// Save forum reply
function saveForumReply(threadId, reply) {
    const replies = getForumReplies(threadId);
    reply.id = replies.length + 1;
    reply.date = new Date().toLocaleDateString('id-ID');
    replies.push(reply);
    localStorage.setItem(`threadReplies_${threadId}`, JSON.stringify(replies));
    
    // Update thread reply count
    const threads = getForumThreads();
    const thread = threads.find(t => t.id == threadId);
    if (thread) {
        thread.replies = replies.length;
        localStorage.setItem('forumThreads', JSON.stringify(threads));
    }
    
    return reply;
}

// Increment thread views
function incrementThreadViews(threadId) {
    const threads = getForumThreads();
    const thread = threads.find(t => t.id == threadId);
    if (thread) {
        thread.views = (thread.views || 0) + 1;
        localStorage.setItem('forumThreads', JSON.stringify(threads));
    }
}
