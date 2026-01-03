@props([
  'img' => null,
  'text' => 'Button',
  'textColor' => 'text-black',
  'height' => 'h-[52px]',
])

<button {{ $attributes->merge([
  'class' => "w-full {$height} rounded-full bg-center bg-no-repeat bg-contain
              flex items-center justify-center font-bold tracking-wide {$textColor}
              active:scale-[0.99] transition"
]) }}
style="{{ $img ? "background-image: url('{$img}');" : '' }}">
  {{ $text }}
</button>
