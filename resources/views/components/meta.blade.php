@php
    $title = $title ?? 'KKN Desa Kutabawa';
    $author_name = 'Tim KKN Desa Kutabawa';
    $description = $description ?? "Temukan informasi lengkap tentang program kerja, dokumentasi kegiatan, dan kontribusi mahasiswa Universitas Pancasakti Tegal dalam membangun desa.";
    $keywords = $keywords ?? 'KKN, Desa Kutabawa, Universitas Pancasakti Tegal, Pengabdian Masyarakat, Program Kerja Mahasiswa';

    // Deteksi apakah ini halaman profil user (contoh: /@aprilla)
    $isProfilePage = request()->is('@*');

    // Ambil avatar jika ini halaman profil dan user tersedia
    $avatar = $user?->avatar ?? null;
    $avatarUrl = $avatar ? asset('storage/avatars/' . $avatar) : url('assets/img/logo.png');

    // Gunakan thumbnail jika tersedia, jika tidak dan ini halaman profil, gunakan avatar
    if (!empty($thumbnail)) {
        $thumbnailUrl = asset('storage/thumbnails/' . $thumbnail);
    } elseif ($isProfilePage && $user) {
        $thumbnailUrl = $avatarUrl;
    } else {
        $thumbnailUrl = url('assets/img/logo.png');
    }
@endphp

<meta name="description" content="{{ strip_tags($description) }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $author_name }}">

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ strip_tags($description) }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $thumbnailUrl }}">
<meta property="og:site_name" content="KKN Desa Kutabawa">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ strip_tags($description) }}">
<meta name="twitter:image" content="{{ $thumbnailUrl }}">

<meta name="robots" content="index, follow, max-image-preview:large">
<meta name="googlebot" content="index, follow">

<link rel="canonical" href="{{ url()->current() }}">
<link rel="alternate" href="{{ url()->current() }}" hreflang="x-default">


<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "{{ $title }}",
      "description": "{{ strip_tags($description) }}",
      "url": "{{ url()->current() }}",
      "inLanguage": "id",
      "author": {
        "@type": "Organization",
        "name": "{{ $author_name }}",
        "email": "contact@kknkutabawa.site"
      },
      "publisher": {
        "@type": "Organization",
        "name": "KKN Desa Kutabawa",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ $thumbnailUrl }}"
        },
        "email": "contact@kknkutabawa.site"
      },
      "image": {
        "@type": "ImageObject",
        "url": "{{ $thumbnailUrl }}",
        "width": 1200,
        "height": 630
      },
      "keywords": "{{ $keywords }}",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ url()->current() }}"
      }
    }
</script>
