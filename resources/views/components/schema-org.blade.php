@props([
    'post' => null,
    'faqs' => null,
    'breadcrumbs' => null,
])

<script type="application/ld+json">
{!! json_encode(\App\Services\SeoHelper::generateOrganizationSchema(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>

<script type="application/ld+json">
{!! json_encode(\App\Services\SeoHelper::generateLocalBusinessSchema(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>

@if(!empty($breadcrumbs))
<script type="application/ld+json">
{!! json_encode(\App\Services\SeoHelper::generateBreadcrumbSchema($breadcrumbs), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if(!empty($post))
<script type="application/ld+json">
{!! json_encode(\App\Services\SeoHelper::generateArticleSchema($post), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif

@if(!empty($faqs) && is_array($faqs) && count($faqs) > 0)
<script type="application/ld+json">
{!! json_encode(\App\Services\SeoHelper::generateFaqSchema($faqs), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
