module User exposing (Id, User(..), idDecoder, userDecoder)

import Json.Decode exposing (Decoder)


type alias UserInfo =
    { id : Id, name : String, email : String }


type alias Id =
    Int


idDecoder : Decoder Id
idDecoder =
    Json.Decode.int


type User
    = Guest
    | Authenticated UserInfo


guestDecoder : Decoder User
guestDecoder =
    Json.Decode.succeed Guest


userInfoDecoder : Decoder UserInfo
userInfoDecoder =
    Json.Decode.map3 UserInfo
        (Json.Decode.field "id" idDecoder)
        (Json.Decode.field "name" Json.Decode.string)
        (Json.Decode.field "email" Json.Decode.string)


authenticatedDecoder : Decoder User
authenticatedDecoder =
    Json.Decode.map Authenticated userInfoDecoder


userDecoder : Decoder User
userDecoder =
    Json.Decode.oneOf [ authenticatedDecoder, guestDecoder ]

