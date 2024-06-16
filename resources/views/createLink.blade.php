<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Link </title>
</head>
<body>
    <div>
        <h1> Gere seu shortLink! </h1>
    </div>

    @session('msg')
        <p> {{ session('msg') }}</p>
    @endsession

    <form method='post' action='links'>
    @csrf

    <input type='text' name='link' placeholder="Sua URL">
    <input type='submit' value='gerar!'>

    </form>
    

    <table>
        <thead>
            <tr>
                <th> Short Url </th>
                <th> Original Url </th>
                <th> Clicks </th>
                <th> Ações </th>
            </tr>         
        </thead>
        <tbody>
           @foreach($links as $link)
                <tr>
                    <td> {{ $link['shortURL'] }}</td>
                    <td> {{ $link['originalURL'] }}</td>
                    <td> {{ $clicks[$link['id']]}} </td>
                    <td> 
                       <form method='post' action='/links/delete/{{$link["id"]}}'>
                       @csrf 
                       @method('DELETE') 
                       <input type='submit' value='Delete'>
                       </form>
                    </td>
                </tr>
           @endforeach

        </tbody>
    </table>
    <div>
        
      
    </div>
</body>
</html>